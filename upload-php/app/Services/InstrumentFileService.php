<?php

namespace App\Services;

use App\Models\Upload;
use App\Models\Instrument;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;


class InstrumentFileService
{
    protected array $desiredFields = [
        'RptDt',
        'TckrSymb',
        'MktNm',
        'SctyCtgyNm',
        'ISIN',
        'CrpnNm'
    ];

    public function process(Upload $upload)
    {
        $path = $upload->path;
        $fullPath = Storage::path($path);

        if (str_ends_with($path, '.csv')) {
            $this->processDelimitedFile($fullPath, $upload, 'csv');
        } elseif (str_ends_with($path, '.xlsx') || str_ends_with($path, '.xls')) {
            $this->processDelimitedFile($fullPath, $upload, 'excel');
        }
    }

    protected function processDelimitedFile(string $fullPath, Upload $upload, string $type): void
    {
        $chunkSize = 50000;
        $header = null;
        $headerIndex = null;
        $batch = [];

        if ($type === 'csv') {
            $handle = fopen($fullPath, 'r');
            $rowIdx = 0;
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                if (empty(array_filter($row)) || str_contains($row[0], 'Status do Arquivo')) {
                    $rowIdx++;
                    continue;
                }
                if (!$header) {
                    $header = array_map('trim', $row);
                    $headerIndex = $rowIdx;
                    $rowIdx++;
                    continue;
                }
                if (count($header) !== count($row)) {
                    $rowIdx++;
                    continue;
                }
                $data = array_combine($header, $row);
                $this->addToBatch($batch, $data, $upload);
                if (count($batch) >= $chunkSize) {
                    Instrument::insert($batch);
                    $batch = [];
                }
                $rowIdx++;
            }
            if (!empty($batch)) {
                Instrument::insert($batch);
            }
            fclose($handle);
        } else if ($type === 'excel') {
            $collection = Excel::toCollection(null, $fullPath)[0];
            if ($collection->isEmpty()) {
                Log::warning('Excel vazio: ' . $fullPath);
                return;
            }
            foreach ($collection as $idx => $row) {
                $rowArray = $row->toArray();
                if (!$header && in_array('RptDt', $rowArray) && in_array('TckrSymb', $rowArray)) {
                    $header = array_map('trim', $rowArray);
                    $headerIndex = $idx;
                    continue;
                }
                if ($header === null || $idx <= $headerIndex) {
                    continue;
                }
                if (count($header) !== count($rowArray)) {
                    continue;
                }
                $data = [];
                for ($i = 0; $i < count($header); $i++) {
                    $key = $header[$i] ?? "col_$i";
                    $data[$key] = $rowArray[$i] ?? null;
                }
                $this->addToBatch($batch, $data, $upload);
                if (count($batch) >= $chunkSize) {
                    Instrument::insert($batch);
                    $batch = [];
                }
            }
            if (!empty($batch)) {
                Instrument::insert($batch);
            }
        }
    }

    protected function addToBatch(array &$batch, array $data, Upload $upload): void
    {
        $filtered = array_intersect_key($data, array_flip($this->desiredFields));
        $batch[] = [
            'upload_id'    => $upload->id,
            'RptDt'        => $filtered['RptDt'] ?? null,
            'TckrSymb'     => $filtered['TckrSymb'] ?? null,
            'MktNm'        => $filtered['MktNm'] ?? null,
            'SctyCtgyNm'   => $filtered['SctyCtgyNm'] ?? null,
            'ISIN'         => $filtered['ISIN'] ?? null,
            'CrpnNm'       => $filtered['CrpnNm'] ?? null,
            'created_at'   => now(),
            'updated_at'   => now(),
        ];
    }
}
