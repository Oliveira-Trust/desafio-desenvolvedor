<?php

namespace App\Services;

use App\Models\Instrument;
use Carbon\Carbon;

class InstrumentService
{
    public function importFromCsv(string $path)
    {
        if (!file_exists($path)) {
            return;
        }

        $handle = fopen($path, 'r');

        fgets($handle);
        fgets($handle);

        $data = [];
        $batchSize = 1000;
        $now = Carbon::now();

        $convert = function($value) {
            return mb_convert_encoding(trim($value ?? ''), 'UTF-8', 'ISO-8859-1');
        };

        try {
            set_time_limit(0);

            while (($row = fgetcsv($handle, 0, ';')) !== false) {
                if (!isset($row[1]) || empty(trim($row[1]))) {
                    continue;
                }

                $data[] = [
                    'ticker'     => $convert($row[1]),
                    'name'       => $convert($row[47] ?? 'N/A'),
                    'segment'    => $convert($row[4] ?? 'N/A'),
                    'currency'   => $convert($row[23] ?? 'BRL'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                if (count($data) === $batchSize) {
                    $this->performUpsert($data);

                    unset($data);
                    $data = [];

                    gc_collect_cycles();
                }
            }

            if (!empty($data)) {
                $this->performUpsert($data);
                unset($data);
            }

        } catch (\Exception $e) {
            throw $e;
        } finally {
            fclose($handle);
        }
    }

    private function performUpsert(array $data)
    {
        Instrument::upsert($data, ['ticker'], ['name', 'segment', 'currency', 'updated_at']);
    }
}
