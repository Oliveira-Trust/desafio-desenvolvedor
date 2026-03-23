<?php

namespace App\Jobs;

use App\Domains\MarketData\Application\Services\MarketDataService;
use App\Domains\Upload\Application\Ports\UploadRepository;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Reader\CSV\Options as CsvOptions;
use OpenSpout\Reader\CSV\Reader as CsvReader;
use OpenSpout\Reader\ODS\Reader as OdsReader;
use OpenSpout\Reader\ReaderInterface;
use OpenSpout\Reader\XLSX\Reader as XlsxReader;
use Throwable;

class ProcessUploadJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private const CHUNK_SIZE = 1000;
    private const BATCH_ADD_SIZE = 20;

    public int $tries;
    public int $timeout;

    public function __construct(
        public readonly int $uploadId,
    ) {
        $this->tries = (int) config('ingestion.jobs.upload.tries', 3);
        $this->timeout = (int) config('ingestion.jobs.upload.timeout', 300);
        $this->onQueue('ingestion');
    }

    public function handle(UploadRepository $uploads): void
    {
        $upload = $uploads->findById($this->uploadId);

        if ($upload === null) {
            return;
        }

        $uploads->markAsProcessing($this->uploadId);

        try {
            $disk = Storage::disk('local');

            if (! $disk->exists($upload->path)) {
                throw new \RuntimeException('Arquivo do upload nao encontrado.');
            }

            $absolutePath = $disk->path($upload->path);
            $reader = $this->createReader($absolutePath);
            $buffer = [];
            $pendingJobs = [];
            $chunkIndex = 0;
            $rowsTotal = 0;
            $batch = null;

            try {
                $reader->open($absolutePath);

                foreach ($reader->getSheetIterator() as $sheet) {
                    foreach ($sheet->getRowIterator() as $row) {
                        $rowData = $this->mapRowToArray($row);

                        if (! $this->shouldSkipRow($rowData)) {
                            $rowsTotal++;
                        }

                        $buffer[] = $rowData;

                        if (count($buffer) < self::CHUNK_SIZE) {
                            continue;
                        }

                        $pendingJobs[] = new ProcessUploadChunkJob($this->uploadId, $buffer, $chunkIndex);
                        $batch = $this->flushPendingJobs($pendingJobs, $batch);

                        $buffer = [];
                        $chunkIndex++;
                    }
                }

                if ($buffer !== []) {
                    $pendingJobs[] = new ProcessUploadChunkJob($this->uploadId, $buffer, $chunkIndex);
                }

                $uploads->setRowsTotal($this->uploadId, $rowsTotal);
                $batch = $this->flushPendingJobs($pendingJobs, $batch, true);

                if ($batch === null) {
                    $uploads->markAsCompleted($this->uploadId);
                    app(MarketDataService::class)->invalidateCache();
                }
            } finally {
                $reader->close();
            }
        } catch (Throwable $exception) {
            if ($this->isTransientFailure($exception)) {
                throw $exception;
            }

            $this->fail($exception);
        }
    }

    private function mapRowToArray(Row $row): array
    {
        return array_map(
            static fn($cell) => $cell->getValue(),
            $row->getCells()
        );
    }

    /**
     * @param  array<int, mixed>  $row
     */
    private function shouldSkipRow(array $row): bool
    {
        $firstColumn = $this->normalizeString($row[0] ?? null);

        if ($firstColumn === null) {
            return true;
        }

        if ($firstColumn === 'RptDt') {
            return true;
        }

        return str_starts_with($firstColumn, 'Status do Arquivo:');
    }

    private function normalizeString(mixed $value): ?string
    {
        if ($value === null) {
            return null;
        }

        $normalized = trim((string) $value);

        return $normalized === '' ? null : $normalized;
    }

    public function failed(?Throwable $exception): void
    {
        app(UploadRepository::class)->markAsFailed(
            $this->uploadId,
            $exception?->getMessage() ?? 'Falha ao iniciar o processamento do upload.'
        );
    }

    private function createReader(string $absolutePath): ReaderInterface
    {
        $extension = strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION));

        return match ($extension) {
            'csv' => $this->createCsvReader(),
            'xlsx' => new XlsxReader(),
            'ods' => new OdsReader(),
            default => throw new \RuntimeException("Formato de arquivo nao suportado: {$extension}"),
        };
    }

    private function createCsvReader(): ReaderInterface
    {
        $options = new CsvOptions();
        $options->FIELD_DELIMITER = ';';
        $options->ENCODING = 'ISO-8859-1';

        return new CsvReader($options);
    }

    /**
     * @param  array<int, ProcessUploadChunkJob>  $pendingJobs
     */
    private function flushPendingJobs(array &$pendingJobs, ?Batch $batch, bool $force = false): ?Batch
    {
        if ($pendingJobs === []) {
            return $batch;
        }

        if (! $force && count($pendingJobs) < self::BATCH_ADD_SIZE) {
            return $batch;
        }

        $uploadId = $this->uploadId;

        if ($batch === null) {
            $batch = Bus::batch($pendingJobs)
                ->name('upload:' . $uploadId . ':ingestion')
                ->onQueue('ingestion')
                ->allowFailures()
                ->finally(function (Batch $batch) use ($uploadId) {
                    $uploads = app(UploadRepository::class);

                    if ($batch->failedJobs > 0) {
                        $uploads->markAsFailed($uploadId, 'Uma ou mais tarefas de ingestao falharam.');

                        return;
                    }

                    $uploads->markAsCompleted($uploadId);
                    app(MarketDataService::class)->invalidateCache();
                })
                ->dispatch();
        } else {
            $batch->add($pendingJobs);
        }

        $pendingJobs = [];

        return $batch;
    }

    public function backoff(): array
    {
        return config('ingestion.jobs.upload.backoff', [10, 30, 60]);
    }

    private function isTransientFailure(Throwable $exception): bool
    {
        $message = strtolower($exception->getMessage());

        return str_contains($message, 'deadlock')
            || str_contains($message, 'lock wait timeout')
            || str_contains($message, 'server has gone away')
            || str_contains($message, 'connection refused')
            || str_contains($message, 'timed out');
    }
}
