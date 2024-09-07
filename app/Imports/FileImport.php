<?php

namespace App\Imports;

use App\Models\FileContent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class FileImport implements ToModel, WithChunkReading, WithBatchInserts
{
    protected $uploadId;

    public function __construct($uploadId)
    {
        $this->uploadId = $uploadId;
    }

    public function model(array $row)
    {
        dd($row); // Undefined array key \"TckrSymb\"" ??
        return new FileContent([
            'tckr_symb' => $row['TckrSymb'],
            'rpt_dt' => $row['RptDt'],
            'mkt_nm' => $row['MktNm'],
            'scty_ctgy_nm' => $row['SctyCtgyNm'],
            'isin' => $row['ISIN'],
            'crpn_nm' => $row['CrpnNm'],
            'upload_id' => $this->uploadId,
        ]);
    }

    /**
     * Número de linhas por lote
     *
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * Número de registros por batch de inserção
     *
     * @return int
     */
    public function batchSize(): int
    {
        return 1000;
    }
}
