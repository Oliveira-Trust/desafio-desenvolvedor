<?php

namespace App\Jobs;

use App\Domains\Upload\Application\Ports\UploadRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Reader\Common\Creator\ReaderFactory;
use OpenSpout\Reader\CSV\Options as CsvOptions;
use OpenSpout\Reader\CSV\Reader as CsvReader;
use OpenSpout\Reader\ReaderInterface;

class ProcessUploadJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private const CHUNK_SIZE = 1000;

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

        $disk = Storage::disk('local');

        if (! $disk->exists($upload->path)) {
            throw new \RuntimeException('Arquivo do upload nao encontrado.');
        }

        $absolutePath = $disk->path($upload->path);
        $reader = $this->createReader($absolutePath);
        $buffer = [];
        $chunkIndex = 0;

        try {
            $reader->open($absolutePath);

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $buffer[] = $this->mapRowToArray($row);

                    if (count($buffer) < self::CHUNK_SIZE) {
                        continue;
                    }

                    $this->dispatchChunk($buffer, $chunkIndex);

                    $buffer = [];
                    $chunkIndex++;
                }
            }

            if ($buffer !== []) {
                $this->dispatchChunk($buffer, $chunkIndex);
            }
        } finally {
            $reader->close();
        }
    }

    private function mapRowToArray(Row $row): array
    {
        return array_map(
            static fn ($cell) => $cell->getValue(),
            $row->getCells()
        );
    }

    private function dispatchChunk(array $rows, int $chunkIndex): void
    {
        ProcessUploadChunkJob::dispatch($this->uploadId, $rows, $chunkIndex)
            ->onQueue('ingestion');
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
}
