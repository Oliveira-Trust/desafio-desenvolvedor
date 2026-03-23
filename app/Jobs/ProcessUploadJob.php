<?php

namespace App\Jobs;

use App\Domains\MarketData\Application\Services\MarketDataService;
use App\Domains\Upload\Application\Ports\UploadRepository;
use App\Jobs\Concerns\DetectsTransientFailures;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
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
    use DetectsTransientFailures;

    private const CHUNK_SIZE = 1000;
    private const BATCH_ADD_SIZE = 20;
    private const REQUIRED_HEADER_COLUMNS = [
        0 => 'RptDt',
        1 => 'TckrSymb',
        5 => 'MktNm',
        6 => 'SctyCtgyNm',
        15 => 'ISIN',
        47 => 'CrpnNm',
    ];

    public int $tries;
    public int $timeout;

    public function __construct(
        public readonly int $uploadId,
        public readonly ?string $requestId = null,
    ) {
        $this->tries = (int) config('ingestion.jobs.upload.tries', 3);
        $this->timeout = (int) config('ingestion.jobs.upload.timeout', 300);
        $this->onQueue('ingestion');
    }

    public function handle(UploadRepository $uploads): void
    {
        $startedAt = microtime(true);
        $upload = $uploads->findById($this->uploadId);

        if ($upload === null) {
            return;
        }

        $this->logInfo('ingestion.upload.started', 'processing', $startedAt, [
            'chunk' => null,
        ]);

        if (! $uploads->markAsProcessing($this->uploadId)) {
            Log::info('ingestion.upload.skipped', $this->buildLogContext([
                'chunk' => null,
                'status' => 'skipped',
                'duration_ms' => $this->durationMs($startedAt),
                'reason' => 'upload_already_processing_or_processed',
            ]));

            return;
        }

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
            $headerValidated = false;

            try {
                $reader->open($absolutePath);

                foreach ($reader->getSheetIterator() as $sheet) {
                    foreach ($sheet->getRowIterator() as $row) {
                        $rowData = $this->mapRowToArray($row);

                        if ($this->isStatusRow($rowData) || $this->isEmptyRow($rowData)) {
                            continue;
                        }

                        if (! $headerValidated) {
                            $this->assertValidHeader($rowData);
                            $headerValidated = true;

                            continue;
                        }

                        if ($this->shouldSkipRow($rowData)) {
                            continue;
                        }

                        $rowsTotal++;
                        $buffer[] = $rowData;

                        if (count($buffer) < self::CHUNK_SIZE) {
                            continue;
                        }

                        $pendingJobs[] = new ProcessUploadChunkJob($this->uploadId, $buffer, $chunkIndex, $this->requestId);
                        $batch = $this->flushPendingJobs($pendingJobs, $batch);

                        $buffer = [];
                        $chunkIndex++;
                    }
                }

                if (! $headerValidated) {
                    throw new \RuntimeException('Header do arquivo ausente ou invalido.');
                }

                if ($buffer !== []) {
                    $pendingJobs[] = new ProcessUploadChunkJob($this->uploadId, $buffer, $chunkIndex, $this->requestId);
                }

                $uploads->setRowsTotal($this->uploadId, $rowsTotal);
                $batch = $this->flushPendingJobs($pendingJobs, $batch, true);

                if ($batch === null) {
                    $uploads->markAsCompleted($this->uploadId);
                    app(MarketDataService::class)->invalidateCache();

                    $this->logInfo('ingestion.upload.completed', 'completed', $startedAt, [
                        'chunk' => null,
                        'rows_total' => $rowsTotal,
                        'chunks_total' => $chunkIndex + ($buffer !== [] ? 1 : 0),
                    ]);
                } else {
                    $this->logInfo('ingestion.upload.chunks_dispatched', 'queued', $startedAt, [
                        'chunk' => null,
                        'rows_total' => $rowsTotal,
                        'chunks_total' => $chunkIndex + ($buffer !== [] ? 1 : 0),
                    ]);
                }
            } finally {
                $reader->close();
            }
        } catch (Throwable $exception) {
            if ($this->shouldRetryAfterFailure($exception)) {
                $this->logWarning('ingestion.upload.retrying', 'retrying', $startedAt, $exception, [
                    'chunk' => null,
                    'retryable' => true,
                ]);

                throw $exception;
            }

            $this->logError('ingestion.upload.failed', 'failed', $startedAt, $exception, [
                'chunk' => null,
                'retryable' => false,
            ]);

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
        return $this->isEmptyRow($row)
            || $this->isHeaderRow($row)
            || $this->isStatusRow($row);
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
        Log::error('ingestion.upload.failed.final', $this->buildLogContext([
            'chunk' => null,
            'status' => 'failed',
            'duration_ms' => 0,
            'exception_class' => $exception ? $exception::class : null,
            'error_message' => $exception?->getMessage() ?? 'Falha ao iniciar o processamento do upload.',
            'attempt' => $this->attempts(),
        ]));

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
        $requestId = $this->requestId;

        if ($batch === null) {
            $batch = Bus::batch($pendingJobs)
                ->name('upload:' . $uploadId . ':ingestion')
                ->onQueue('ingestion')
                ->allowFailures()
                ->finally(function (Batch $batch) use ($uploadId, $requestId) {
                    $uploads = app(UploadRepository::class);

                    if ($batch->failedJobs > 0) {
                        Log::error('ingestion.upload.batch_finished', [
                            'request_id' => $requestId,
                            'upload_id' => $uploadId,
                            'chunk' => null,
                            'attempt' => null,
                            'status' => 'failed',
                            'duration_ms' => 0,
                            'failed_jobs' => $batch->failedJobs,
                            'total_jobs' => $batch->totalJobs,
                        ]);

                        $uploads->markAsFailed($uploadId, 'Uma ou mais tarefas de ingestao falharam.');

                        return;
                    }

                    $uploads->markAsCompleted($uploadId);
                    app(MarketDataService::class)->invalidateCache();

                    Log::info('ingestion.upload.batch_finished', [
                        'request_id' => $requestId,
                        'upload_id' => $uploadId,
                        'chunk' => null,
                        'attempt' => null,
                        'status' => 'completed',
                        'duration_ms' => 0,
                        'failed_jobs' => $batch->failedJobs,
                        'total_jobs' => $batch->totalJobs,
                    ]);
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

    /**
     * @param  array<int, mixed>  $row
     */
    private function assertValidHeader(array $row): void
    {
        foreach (self::REQUIRED_HEADER_COLUMNS as $index => $expectedColumn) {
            $actualColumn = $this->normalizeString($row[$index] ?? null);

            if ($actualColumn !== $expectedColumn) {
                throw new \RuntimeException('Header do arquivo invalido.');
            }
        }
    }

    /**
     * @param  array<int, mixed>  $row
     */
    private function isEmptyRow(array $row): bool
    {
        return $this->normalizeString($row[0] ?? null) === null;
    }

    /**
     * @param  array<int, mixed>  $row
     */
    private function isHeaderRow(array $row): bool
    {
        return $this->normalizeString($row[0] ?? null) === 'RptDt';
    }

    /**
     * @param  array<int, mixed>  $row
     */
    private function isStatusRow(array $row): bool
    {
        $firstColumn = $this->normalizeString($row[0] ?? null);

        return $firstColumn !== null && str_starts_with($firstColumn, 'Status do Arquivo:');
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private function buildLogContext(array $context = []): array
    {
        return array_merge([
            'request_id' => $this->requestId,
            'upload_id' => $this->uploadId,
            'attempt' => $this->attempts(),
        ], $context);
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private function logInfo(string $message, string $status, float $startedAt, array $context = []): void
    {
        Log::info($message, $this->buildLogContext(array_merge($context, [
            'status' => $status,
            'duration_ms' => $this->durationMs($startedAt),
        ])));
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private function logWarning(string $message, string $status, float $startedAt, Throwable $exception, array $context = []): void
    {
        Log::warning($message, $this->buildLogContext(array_merge($context, [
            'status' => $status,
            'duration_ms' => $this->durationMs($startedAt),
            'exception_class' => $exception::class,
            'error_message' => $exception->getMessage(),
        ])));
    }

    /**
     * @param  array<string, mixed>  $context
     */
    private function logError(string $message, string $status, float $startedAt, Throwable $exception, array $context = []): void
    {
        Log::error($message, $this->buildLogContext(array_merge($context, [
            'status' => $status,
            'duration_ms' => $this->durationMs($startedAt),
            'exception_class' => $exception::class,
            'error_message' => $exception->getMessage(),
        ])));
    }

    private function durationMs(float $startedAt): int
    {
        return (int) ((microtime(true) - $startedAt) * 1000);
    }
}
