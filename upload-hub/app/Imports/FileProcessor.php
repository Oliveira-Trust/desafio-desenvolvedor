<?php

namespace App\Imports;

use App\Repositories\ImportDataFileRepository;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class FileProcessor implements OnEachRow, WithChunkReading, WithHeadingRow
{
    private int $totalLines = 0;
    private int $processedLines = 0;

    public function __construct(
        private ImportDataFileRepository $importDataFileRepository,
        private $uploadFileId
    )
    {        
    }    
    
    public function onRow(Row $row)
    { 
        $this->totalLines++;

        try{
            $line = $row->getIndex(); 
            $data = $row->toArray();
            
            $teste = $this->importDataFileRepository->create([
                'upload_file_id' => $this->uploadFileId,
                'line_number' => $line,
                'content' => $data
            ]);

            $this->processedLines++;
        }catch(\Exception $e){
            Log::warning("Erro processando linha $line: " . $e->getMessage());
            throw $e;
        }
        
        
    }

    public function headingRow(): int
    {
        return 2; // segunda linha como cabeçalho
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function getTotalLines(): int
    {
        return $this->totalLines;
    }

    public function getProcessedLines(): int
    {
        return $this->processedLines;
    }
    
}  