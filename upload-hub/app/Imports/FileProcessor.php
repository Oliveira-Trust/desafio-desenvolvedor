<?php

namespace App\Imports;


use App\Models\ImportDataFile;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;

class FileProcessor implements ToCollection, WithHeadingRow, WithChunkReading,
    WithStartRow
{

    public function __construct(
        private $uploadFileId
    )
    {        
    }
    
    
     public function startRow(): int
    {
        return 2;
    }
    
    public function collection(Collection $rows)
    {

        $batch = [];

        foreach ($rows as $row) {
            $batch[] = [
                'upload_file_id' => $this->uploadFileId,
                'RptDt'         => isset($row['RptDt']) ? date('Y-m-d', strtotime($row['RptDt'])) : null,
                'TckrSymb'      => $row['TckrSymb'] ?? null,
                'MktNm'         => $row['MktNm'] ?? null,
                'SctyCtgyNm'    => $row['SctyCtgyNm'] ?? null,
                'ISIN'          => $row['ISIN'] ?? null,
                'CrpnNm'        => $row['CrpnNm'] ?? null,                
            ];
        }

        ImportDataFile::insert($batch);
        
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    
}  