<?php

namespace App\Services;

use App\Repositories\ImportDataFileRepository;
use App\Repositories\UploadFileRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FileProcessor;
use Illuminate\Support\Facades\Log;

class ImportDataFileService
{
    public function __construct(
        private ImportDataFileRepository $importDataFileRepository,
        private UploadFileRepository $fileUploadRepository,

    )
    {
    }

    public function processFile($updateFileId, $filePath)
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        try {

            $this->fileUploadRepository->update(
                ['status' => 1], 
                $updateFileId
            );

            $processed = new FileProcessor($this->importDataFileRepository, $updateFileId);
            if ($extension === 'csv') {
                Excel::import($processed, $filePath, null, \Maatwebsite\Excel\Excel::CSV);
            } elseif ($extension === 'xlsx') {
                Excel::import( $processed, $filePath, null, \Maatwebsite\Excel\Excel::XLSX);
            }

            $this->fileUploadRepository->update([
                'status' => 2,
                'linhas_total' => $processed->getTotalLines(),
                'linhas_processadas' => $processed->getProcessedLines()
            ], $updateFileId);

       } catch (\Exception $e) {

            $this->fileUploadRepository->update([
                'status' => 3,
            ], $updateFileId);
            
            Log::error("Erro ao processar file", [
                'error' => $e->getMessage(),
                
            ]);

            throw $e;
       }
    }
}