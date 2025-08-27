<?php

namespace App\Jobs;

use App\Services\ImportDataFileService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessImportDataJob implements ShouldQueue
{
    use Queueable, Dispatchable;

    private int $updateFileId;
    private string $filePath;

    /**
     * Create a new job instance.
     */
    public function __construct(int $updateFileId, string $filePath)
    {
        $this->updateFileId = $updateFileId;
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(ImportDataFileService $importDataFileService): void
    {
        try {
            $importDataFileService->processFile($this->updateFileId, $this->filePath);
        } catch (\Exception $e) {
            Log::error('Erro no job: ' . $e->getMessage());
            throw $e;
        }
        
    }
}
