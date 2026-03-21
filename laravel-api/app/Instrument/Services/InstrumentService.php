<?php

declare(strict_types=1);

namespace App\Instrument\Services;

use App\FileUpload\Models\FileUpload;
use App\Instrument\Interfaces\InstrumentRepositoryInterface;
use App\Instrument\Models\Instrument;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\LazyCollection;

class InstrumentService
{
    public function __construct(
        private readonly InstrumentRepositoryInterface $instrumentRepository,
    ) {}

    public function execute(FileUpload $fileUpload): void
    {
        $fileUpload->update(['status' => 'processing']);

        try {
            $path = Storage::path($fileUpload->stored_name);
            $totalRows = 0;

            LazyCollection::make(function () use ($path) {
                $handle = fopen($path, 'r');

                $header = null;

                while (($row = fgetcsv($handle, 0, ';')) !== false) {
                    $normalized = array_map(fn ($col) => trim(str_replace("\xEF\xBB\xBF", '', $col)), $row);

                    if (in_array('RptDt', $normalized)) {
                        $header = $normalized;
                        break;
                    }
                }

                if (! $header) {
                    throw new \RuntimeException('Header RptDt não encontrado no arquivo.');
                }

                while (($row = fgetcsv($handle, 0, ';')) !== false) {
                    if (count($row) === count($header)) {
                        $utf8Row = array_map(
                            fn ($value) => $this->toUtf8($value),
                            $row
                        );
                        yield array_combine($header, $utf8Row);
                    }
                }

                fclose($handle);
            })
                ->chunk(1000)
                ->each(function ($chunk) use ($fileUpload, &$totalRows) {
                    $records = $chunk->map(fn ($row) => [
                        'file_upload_id' => $fileUpload->id,
                        'RptDt' => $row['RptDt'] ?? null,
                        'TckrSymb' => $row['TckrSymb'] ?? null,
                        'MktNm' => $row['MktNm'] ?? null,
                        'SctyCtgyNm' => $row['SctyCtgyNm'] ?? null,
                        'ISIN' => $row['ISIN'] ?? null,
                        'CrpnNm' => $row['CrpnNm'] ?? null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ])->toArray();

                    Instrument::insert($records);
                    $totalRows += count($records);
                });

            $fileUpload->update([
                'status' => 'done',
                'total_rows' => $totalRows,
            ]);

        } catch (\Throwable $e) {
            $fileUpload->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    public function search(?string $tckrSymb = null, ?string $rptDt = null): mixed
    {
        $cacheKey = 'instruments:'.md5("{$tckrSymb}:{$rptDt}");

        return Cache::remember($cacheKey, now()->addMinutes(30), function () use ($tckrSymb, $rptDt) {
            $result = $this->instrumentRepository->searchInstruments($tckrSymb, $rptDt);

            if ($result instanceof LengthAwarePaginator) {
                return [
                    'data' => $result->items(),
                    'current_page' => $result->currentPage(),
                    'per_page' => $result->perPage(),
                    'total' => $result->total(),
                    'last_page' => $result->lastPage(),
                ];
            }

            return $result->toArray();
        });
    }

    private function toUtf8(?string $value): ?string
    {
        if ($value === null) {
            return null;
        }

        return mb_check_encoding($value, 'UTF-8')
            ? $value
            : mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
    }
}
