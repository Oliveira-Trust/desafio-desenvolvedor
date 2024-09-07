<?php

namespace App\Imports;

use App\Models\FileContent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FileImport implements ToModel, WithChunkReading, WithBatchInserts, WithHeadingRow
{
    protected $uploadId;

    public function __construct($uploadId)
    {
        $this->uploadId = $uploadId;
    }

    public function model(array $row)
    {
//        dd($row);
        return new FileContent([
            'rpt_dt' => $this->convertDateFormat($row['rptdt']),
            'tckr_symb' => $row['tckrsymb'],
            'mkt_nm' => $row['mktnm'],
            'scty_ctgy_nm' => $row['sctyctgynm'],
            'isin' => $row['isin'],
            'crpn_nm' => $row['crpnnm'],
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

    // Converte de DD/MM/YYYY para YYYY-MM-DD
    public function convertDateFormat($date)
    {
        if (empty($date)) {
            return null;
        }

        // Converte a data de DD/MM/YYYY para YYYY-MM-DD
        $dateObject = \DateTime::createFromFormat('d/m/Y', $date);
        if ($dateObject) {
            return $dateObject->format('Y-m-d');
        }

        return null;
    }
}
