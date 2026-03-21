<?php

namespace App\Jobs;

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
use OpenSpout\Reader\Common\Creator\ReaderFactory;
use OpenSpout\Reader\CSV\Options as CsvOptions;
use OpenSpout\Reader\CSV\Reader as CsvReader;
use OpenSpout\Reader\ReaderInterface;
use Throwable;

class ProcessUploadJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private const CHUNK_SIZE = 1000;
    private const BATCH_ADD_SIZE = 20;

    public function __construct(
        public readonly int $uploadId,
    ) {
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
            $batch = null;

            try {
                $reader->open($absolutePath);

                foreach ($reader->getSheetIterator() as $sheet) {
                    foreach ($sheet->getRowIterator() as $row) {
                        $buffer[] = $this->mapRowToArray($row);

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

                $batch = $this->flushPendingJobs($pendingJobs, $batch, true);

                if ($batch === null) {
                    $uploads->markAsCompleted($this->uploadId);
                }
            } finally {
                $reader->close();
            }
        } catch (Throwable $exception) {
            $uploads->markAsFailed($this->uploadId, $exception->getMessage());

            throw $exception;
        }
    }

    private function mapRowToArray(Row $row): array
    {
        return array_map(
            static fn ($cell) => $cell->getValue(),
            $row->getCells()
        );
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
        if (strtolower(pathinfo($absolutePath, PATHINFO_EXTENSION)) !== 'csv') {
            return ReaderFactory::createFromFile($absolutePath);
        }

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
                })
                ->dispatch();
        } else {
            $batch->add($pendingJobs);
        }

        $pendingJobs = [];

        return $batch;
    }
}
