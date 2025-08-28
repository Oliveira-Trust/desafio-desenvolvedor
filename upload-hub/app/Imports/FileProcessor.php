<?php

namespace App\Imports;

ini_set('memory_limit', '2G');

use Maatwebsite\Excel\Row;
use App\Models\ImportDataFile;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\OnEachRow;
use App\Repositories\ImportDataFileRepository;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class FileProcessor implements OnEachRow, WithChunkReading, WithHeadingRow
{
    private int $totalLines = 0;
    private int $processedLines = 0;
    private array $batch = [];

    public function __construct(
        private ImportDataFileRepository $importDataFileRepository,
        private $uploadFileId
    )
    {        
    }    
    
    public function onRow(Row $row)
    { 
        $this->totalLines++;

        $line = $row->getIndex(); 
        $data = $row->toArray();
        
        $this->importDataFileRepository->create([
            'upload_file_id' => $this->uploadFileId,
            'line_number' => $line,
            'content' => $data
        ]);

        $this->processedLines++;       
        
        
    }

    public function headingRow(): int
    {
        return 2; // segunda linha como cabeçalho
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