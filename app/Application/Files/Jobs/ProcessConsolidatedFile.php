<?php

namespace Application\Files\Jobs;

use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;

class ProcessConsolidatedFile implements ShouldQueue
{
    use Dispatchable, Queueable;

    private string $path;

    /**
     * Create a new job instance.
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $stream = Storage::disk('s3')->readStream($this->path);
        if (!$stream  || !is_resource($stream )) {
            throw new Exception('Error on read file stream');
        }

        $filename = basename($this->path);
        $ext = pathinfo($this->path, PATHINFO_EXTENSION);

        $strategy = match (strtolower($ext)) {
            'csv' => \Application\Files\Strategies\CSVProcessingStrategy::class,
            'xlsx', 'xls' => \Application\Files\Strategies\ExcelProcessingStrategy::class,
            default => throw new Exception('Strategy not implemented to file'),
        };

        $strategyInstance = app($strategy);
        $strategyInstance->run($filename, $stream);
    }
}
