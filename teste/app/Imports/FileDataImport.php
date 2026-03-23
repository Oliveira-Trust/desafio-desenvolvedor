<?php

namespace App\Imports;

use App\Models\FileData;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Facades\Log;

class FileDataImport implements OnEachRow, WithHeadingRow, WithChunkReading, ShouldQueue {
    private $fileId;
    private $headingRow;

    public function __construct($fileId, $headingRow = 1) {
        $this->fileId = $fileId;
        $this->headingRow = $headingRow;
    }

    public function headingRow(): int {
        return (int) $this->headingRow;
    }

    public function onRow(Row $row) {
        $data = $row->toArray();
        try {
            FileData::create([
                'file_id'    => $this->fileId,
                'RptDt'      => $data['rptdt'] ?? null,
                'TckrSymb'   => $data['tckrsymb'] ?? null,
                'MktNm'      => $data['mktnm'] ?? null,
                'SctyCtgyNm' => $data['sctyctgynm'] ?? null,
                'ISIN'       => $data['isin'] ?? null,
                'CrpnNm'     => $data['crpnnm'] ?? null,
            ]);
        } catch (\Exception $e) {
            Log::error('ERRO AO SALVAR NO MONGO: ' . $e->getMessage());
        }
    }

    public function chunkSize(): int {
        return 1000;
    }
}
