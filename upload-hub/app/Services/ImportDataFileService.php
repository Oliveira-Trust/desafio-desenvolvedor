<?php

namespace App\Services;

use App\Repositories\ImportDataFileRepository;
use App\Repositories\UploadFileRepository;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FileProcessor;
use Illuminate\Support\Facades\File;
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
        $excelCachePath = storage_path('framework/cache/laravel-excel');

        if (!File::exists($excelCachePath)) {
            File::makeDirectory($excelCachePath, 0755, true); // cria recursivamente
        }       

        $this->fileUploadRepository->update(
            ['status' => 1], 
            $updateFileId
        );

        Excel::import(new FileProcessor($this->importDataFileRepository, $updateFileId), $filePath);

        
        $this->fileUploadRepository->update([
            'status' => 2,            
        ], $updateFileId);

    
    }
}