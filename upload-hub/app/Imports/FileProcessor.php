<?php

namespace App\Imports;


use DateTime;
use Carbon\Carbon;
use App\Models\ImportDataFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class FileProcessor implements
    ToCollection,
    WithHeadingRow,
    WithChunkReading,
    WithCustomCsvSettings,
    WithStartRow
{

    public function __construct(
        private $uploadFileId        
    )
    {    
        HeadingRowFormatter::default('none'); 
    }
    
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
        ];
    }
    

    public function collection(Collection $rows)
    {
        $batch = [];

        foreach ($rows as $row) {
            $batch[] = [
                'upload_file_id' => $this->uploadFileId,
                'RptDt'  => (!empty($row['RptDt']) && $d = DateTime::createFromFormat('d/m/Y', str_replace(["\n","\r"], '', trim($row['RptDt'])))) ? $d->format('Y-m-d') : null,
                'TckrSymb' => $row['TckrSymb'] ?? null,
                'MktNm' => $row['MktNm'] ?? null,
                'SctyCtgyNm' => $row['SctyCtgyNm'] ?? null,
                'ISIN'  => $row['ISIN'] ?? null,
                'CrpnNm' => $row['CrpnNm'] ?? null,                
            ];
        }

        ImportDataFile::insert($batch);
        
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function startRow(): int
    {
        return 2;
    }    

    public function chunkSize(): int
    {
        return 1000;
    }

    
}  