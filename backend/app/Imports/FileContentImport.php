<?php
namespace App\Imports;

use App\Models\FileContent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FileContentImport implements ToModel, WithHeadingRow
{
    public function model(array $row): ?FileContent
    {
        // Agora as chaves do array serão os nomes das colunas do CSV
        return new FileContent([
            'RptDt' => $row['RptDt'], // Use as chaves em minúsculas
            'TckrSymb' => $row['TckrSymb'],
            'MktNm' => $row['MktNm'],
            'SctyCtgyNm' => $row['SctyCtgyNm'],
            'ISIN' => $row['ISIN'],
            'CrpnNm' => $row['CrpnNm'],
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';', // Configura o delimitador
        ];
    }
}

