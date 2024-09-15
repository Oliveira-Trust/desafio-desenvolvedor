<?php

namespace App\Imports;

use App\Models\FileContent;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeImport;
use Illuminate\Support\Facades\Log;

class FileContentImport implements ToModel, WithHeadingRow, WithCustomCsvSettings, WithChunkReading, WithEvents
{
    protected $uploadId;
    protected $skipFirstRow = false; // Flag para indicar se deve pular a primeira linha

    public function __construct($uploadId)
    {
        $this->uploadId = $uploadId;
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';',
        ];
    }

    public function headingRow(): int
    {
        return $this->skipFirstRow ? 2 : 1; // Define a linha de cabeçalho, ignorando a primeira linha se necessário
    }

    public function model(array $row)
    {
        // Converte todas as chaves do array $row para minúsculas
        $row = array_change_key_case($row, CASE_LOWER);

        // Adicione logs para verificar o conteúdo do array
        Log::info('Conteúdo da linha do CSV:', $row);
        Log::info('Chaves disponíveis:', array_keys($row));

        // Verifique se o conteúdo é um array associativo com chaves esperadas
        if (!is_array($row) || empty($row)) {
            Log::error('Linha do CSV está vazia ou não é um array.');
            return null;
        }

        // Mapeamento de chaves do CSV para as chaves esperadas
        $keyMapping = [
            'rptdt'        => 'RptDt',
            'tckrsymb'     => 'TckrSymb',
            'mktnm'        => 'MktNm',
            'sctyctgynm'   => 'SctyCtgyNm',
            'isin'         => 'ISIN',
            'crpnnm'       => 'CrpnNm',
        ];

        // Verifica se todas as chaves esperadas estão presentes e define valores padrão se necessário
        foreach ($keyMapping as $csvKey => $expectedKey) {
            if (!array_key_exists($csvKey, $row) || empty($row[$csvKey])) {
                Log::warning("Chave ausente ou valor vazio no array \$row: $csvKey. Definindo valor padrão.");
                $row[$csvKey] = 'N/A'; // Define um valor padrão
            }
        }

        $fileContent = new FileContent([
            'upload_id'     => $this->uploadId,
            'RptDt'         => $row['rptdt'],
            'TckrSymb'      => $row['tckrsymb'],
            'MktNm'         => $row['mktnm'],
            'SctyCtgyNm'    => $row['sctyctgynm'],
            'ISIN'          => $row['isin'],
            'CrpnNm'        => $row['crpnnm'],
        ]);

        Log::info('Salvando FileContent:', $fileContent->toArray());

        return $fileContent;
    }

    public function chunkSize(): int
    {
        return 1000; // Processa 1000 linhas por vez
    }

    public function registerEvents(): array
    {
        return [
            BeforeImport::class => function (BeforeImport $event) {
                // Lê a primeira linha do arquivo CSV
                $csvFile = fopen(request()->file('file')->getRealPath(), 'r');
                $firstLine = fgetcsv($csvFile, 0, ';');
                fclose($csvFile);

                // Verifica se a primeira linha contém "Status do Arquivo: Parcial"
                if ($firstLine && strpos($firstLine[0], 'Status do Arquivo: Parcial') !== false) {
                    $this->skipFirstRow = true; // Define a flag para pular a primeira linha
                }
            },
        ];
    }
}
