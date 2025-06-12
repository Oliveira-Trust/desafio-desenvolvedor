<?php

namespace Application\Files\Strategies;

use Exception;
use Illuminate\Support\Facades\Storage;
use Infrastructure\Laravel\Database\Repositories\MongoDBConsolidatedFileRepository;
use React\EventLoop\Loop;
use React\Stream\ReadableResourceStream;
use Clue\React\Csv\Decoder;
use Illuminate\Support\Facades\Log;

final class CSVProcessingStrategy implements ProcessingStrategy {
    private int $totalLines = 0;

    private int $chunkSize = 1000;

    private array $chunk = [];

    private array $header = [];

    public function __construct(
        private MongoDBConsolidatedFileRepository $repository
    ){}

    private function clear(): void
    {
        $this->totalLines = 0;
        $this->chunk = [];
        $this->header = [];
    }

    public function run(string $filename, $resource): void
    {
        $loop = Loop::get();
        $stream = new ReadableResourceStream($resource, $loop);
        $csv = new Decoder($stream, ';');

        $isMetadata = true;
        $csv->on('data', function (array $data) use ($filename, &$isMetadata) {
            if ($isMetadata) {
                $isMetadata = false;
                return;
            }

            if (empty($this->header)) {
                $this->header = $data;
                return;
            }

            $data = array_map(function ($value) {
                return mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
            }, $data);

            $rowData = array_combine($this->header, $data);
            $this->chunk[] = $rowData;
            $this->totalLines++;

            if (count($this->chunk) >= $this->chunkSize) {
                $this->repository->registerLine($filename, $this->chunk);
                $this->chunk = [];
            }
        });

        $csv->on('end', function () use (&$chunk, $filename, $loop) {
            Log::info("File process end with total lines {$this->totalLines}");
            if (!empty($chunk)) {
                $chunkSize = count($chunk);
                Log::info("Insert rest chunk {$chunkSize}");
                $this->repository->registerLine($filename, $chunk);
            }
            $this->clear();
            $loop->stop();
        });

        $csv->on('error', function (Exception $e) use ($loop) {
            Log::error('Erro on decoder CSV file.', ['error' => $e->getMessage()]);
            $this->clear();
            $loop->stop();
        });

        $loop->run();
    }
}
