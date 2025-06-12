<?php

namespace Application\Files\Strategies;

use Exception;
use Domain\Files\Enums\ConsolidatedFileStatus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Infrastructure\Laravel\Database\Repositories\MongoDBConsolidatedFileRepository;
use OpenSpout\Reader\XLSX\Reader;

final class ExcelProcessingStrategy implements ProcessingStrategy {
    private array $header = [];

    private array $chunk = [];

    private int $chunkSize = 1000;

    private int $totalLines = 0;

    public function __construct(
        private MongoDBConsolidatedFileRepository $repository
    ){}

    public function run(string $filename, $resource): void
    {
        try {
            $localPath = storage_path('app/private/temp/'.$filename);
            $reader = new Reader();
            $storagePath = 'temp/'.$filename;

            Storage::disk('local')->put($storagePath, $resource);

            $reader->open($localPath);

            foreach($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $cells = $row->toArray();

                    if (empty($this->header)) {
                        $this->header = $cells;
                        continue;
                    }

                    if (count($this->header) !== count($cells)) {
                        Log::warning("Skipping line {$this->totalLines} due to column count mismatch.", [
                            'filename' => $filename
                        ]);
                    }

                    $rowData = array_combine($this->header, $cells);
                    $this->chunk[] = $rowData;
                    $this->totalLines++;

                    if (count($this->chunk) >= $this->chunkSize) {
                        $this->repository->registerLine($filename, $this->chunk);
                        $this->chunk = [];
                    }
                }
            }

            if (!empty($this->chunk)) {
                $this->repository->registerLine($filename, $this->chunk);
                $this->chunk = [];
            }

            $this->repository->updateStatus($filename, ConsolidatedFileStatus::COMPLETED);

            Log::info("File process finished for {$filename}. Total data lines: {$this->totalLines}");
            Storage::disk('local')->delete($storagePath);

            $reader->close();
        } catch (Exception $e) {
            $this->repository->updateStatus(
                $filename,
                ConsolidatedFileStatus::COMPLETED_WITH_ERROR,
            );
            Log::error("Error on process file: {$e->getMessage()}");
        }
    }

}
