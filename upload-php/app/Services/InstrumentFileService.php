<?php

namespace App\Services;

use App\Models\Upload;
use App\Models\Instrument;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InstrumentFileService
{
    public function process(Upload $upload)
    {
        $path = $upload->path;
        $fullPath = Storage::path($path);

        if (str_ends_with($path, '.csv')) {
            $rows = [];
            $header = null;
            $handle = fopen($fullPath, 'r');
            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                if (!$header) {
                    $header = $row;
                    continue;
                }
                $rows[] = array_combine($header, $row);
            }
            fclose($handle);

            foreach ($rows as $data) {
                Instrument::create([
                    'upload_id' => $upload->id,
                    'RptDt' => $data['RptDt'] ?? null,
                    'TckrSymb' => $data['TckrSymb'] ?? null,
                    'MktNm' => $data['MktNm'] ?? null,
                    'SctyCtgyNm' => $data['SctyCtgyNm'] ?? null,
                    'ISIN' => $data['ISIN'] ?? null,
                    'CrpnNm' => $data['CrpnNm'] ?? null,
                ]);
            }
        } elseif (str_ends_with($path, '.xlsx') || str_ends_with($path, '.xls')) {
            $collection = Excel::toCollection(null, $fullPath)[0];
            $header = $collection->first()->toArray();
            $rows = $collection->slice(1);

            foreach ($rows as $row) {
                $data = array_combine($header, $row->toArray());
                Instrument::create([
                    'upload_id' => $upload->id,
                    'RptDt' => $data['RptDt'] ?? null,
                    'TckrSymb' => $data['TckrSymb'] ?? null,
                    'MktNm' => $data['MktNm'] ?? null,
                    'SctyCtgyNm' => $data['SctyCtgyNm'] ?? null,
                    'ISIN' => $data['ISIN'] ?? null,
                    'CrpnNm' => $data['CrpnNm'] ?? null,
                ]);
            }
        }
    }
}