<?php

namespace App\Imports;

namespace App\Imports;

use App\Models\FileContent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\Importable;

class FileImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    use Importable;
    protected $uploadId;

    public function __construct($uploadId)
    {
        $this->uploadId = $uploadId;
    }

    /**
     * Row que será definida como cabeçalho.
     *
     * @return int
     */
    public function headingRow(): int
    {
        return 2;
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
        dump($date);
        if (empty($date)) {
            return null;
        }

        // Converte a data de DD/MM/YYYY para YYYY-MM-DD
        $dateObject = \DateTime::createFromFormat('d/m/Y', $date);
        dump($dateObject);
        dd($dateObject->format('Y-m-d'));
        if ($dateObject) {
            return $dateObject->format('Y-m-d');
        }

        return null;
    }
}
