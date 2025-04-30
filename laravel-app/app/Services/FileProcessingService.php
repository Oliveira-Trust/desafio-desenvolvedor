<?php

namespace App\Services;

use App\Models\Upload;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class FileProcessingService
{
    /**
     * Process a file upload.
     *
     * @param \App\Models\Upload $upload
     * @return array
     */
    public function processFile(Upload $upload)
    {
        $filePath = $upload->file_path;
        $fileContent = Storage::disk('uploads')->get($filePath);
        
        $tempFilePath = tempnam(sys_get_temp_dir(), 'file_');
        file_put_contents($tempFilePath, $fileContent);
        
        try {
            $extension = strtolower(pathinfo($upload->file_name, PATHINFO_EXTENSION));
            
            if ($extension === 'csv') {
                $data = $this->processCsvFile($tempFilePath);
            } elseif (in_array($extension, ['xlsx', 'xls'])) {
                $data = $this->processExcelFile($tempFilePath);
            } else {
                throw new \Exception("Unsupported file type: {$extension}");
            }
            
            return $data;
        } finally {
            if (file_exists($tempFilePath)) {
                unlink($tempFilePath);
            }
        }
    }
    
    /**
     * Process a CSV file.
     *
     * @param string $filePath
     * @return array
     */
    protected function processCsvFile($filePath)
    {
        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0);
        
        $records = $csv->getRecords();
        $data = [];
        
        foreach ($records as $record) {
            $data[] = $record;
        }
        
        return $data;
    }
    
    /**
     * Process an Excel file using Spout.
     *
     * @param string $filePath
     * @return array
     */
    protected function processExcelFile($filePath)
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        $reader = ReaderEntityFactory::createReaderFromFile($filePath);
        $reader->open($filePath);
        
        $data = [];
        $headers = null;
        
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $rowIndex => $row) {
                $rowValues = $row->toArray();
                
                if ($rowIndex === 1) {
                    $headers = $rowValues;
                    continue;
                }
                
                if (empty(array_filter($rowValues))) {
                    continue;
                }
                
                $record = [];
                foreach ($headers as $colIndex => $header) {
                    $record[$header] = $rowValues[$colIndex] ?? null;
                }
                
                $data[] = $record;
            }
            
            break;
        }
        
        $reader->close();
        return $data;
    }
} 