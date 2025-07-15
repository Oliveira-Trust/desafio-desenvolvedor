<?php

namespace App\Services;

use App\Models\Record;
use App\Models\Upload;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class RecordImporter
{
    /**
     * Lê o arquivo XLS/CSV e grava linhas na coleção/DB.
     */
    public function handle(UploadedFile $file, Upload $upload): void
    {
        Excel::import(
            // Importador anônimo
            new class ($upload) implements ToModel, WithHeadingRow, WithChunkReading {

                public function __construct(private Upload $upload) {}

                /**
                 * Mapear cada linha da planilha para um Model.
                 * Retorne `null` para pular linhas vazias.
                 */
                public function model(array $row): ?Record
                {
                    // As chaves vêm normalizadas para snake_case e minúsculas:
                    // "RptDt" => "rpt_dt", "TckrSymb" => "tckr_symb" …
                    if (empty($row['tckr_symb']) || empty($row['rpt_dt'])) {
                        return null; // ignora linhas inválidas
                    }

                    return new Record([
                        'upload_id'    => $this->upload->id,
                        'RptDt'        => $this->excelDateToCarbon($row['rpt_dt']),
                        'TckrSymb'     => trim($row['tckr_symb']),
                        'MktNm'        => $row['mkt_nm']       ?? null,
                        'SctyCtgyNm'   => $row['scty_ctgy_nm'] ?? null,
                        'ISIN'         => $row['isin']         ?? null,
                        'CrpnNm'       => $row['crpn_nm']      ?? null,
                    ]);
                }

                /**
                 * Carregar 1 000 linhas por vez → menos memória.
                 */
                public function chunkSize(): int
                {
                    return 1000;
                }

                /**
                 * Converte número serial do Excel ou string de data para Carbon.
                 */
                private function excelDateToCarbon(mixed $value): Carbon
                {
                    // Se for numérico (serial), usa helper da PhpSpreadsheet.
                    if (is_numeric($value)) {
                        return Carbon::instance(ExcelDate::excelToDateTimeObject($value));
                    }

                    // Se já for string/DateTime, deixa o Carbon fazer o parse.
                    return Carbon::parse($value);
                }
            },
            $file     // arquivo recebido
        );
    }
}
