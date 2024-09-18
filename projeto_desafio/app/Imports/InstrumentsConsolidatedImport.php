<?php

namespace App\Imports;

use App\Models\InstrumentsConsolidatedFile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class InstrumentsConsolidatedImport implements ToModel, WithChunkReading, WithBatchInserts, ShouldQueue, WithStartRow
{
    public function model(array $row): InstrumentsConsolidatedFile
    {
        return new InstrumentsConsolidatedFile([
            'RptDt' => $this->checkAndReturnValue($row, 0),
            'TckrSymb' => $this->checkAndReturnValue($row, 1),
            'MktNm' => $this->checkAndReturnValue($row, 5),
            'SctyCtgyNm' => $this->checkAndReturnValue($row, 6),
            'ISIN' => $this->checkAndReturnValue($row, 15),
            'CrpnNm' => $this->checkAndReturnValue($row, 47),
        ]);

    }

    private function checkAndReturnValue(array $row, int $key): string|null
    {
        return key_exists($key, $row) ? $row[$key] : null;
    }

    public function chunkSize(): int
    {
        return 10000;
    }

    public function batchSize(): int
    {
        return 10000;
    }

    public function startRow(): int
    {
        return 3;
    }
}
