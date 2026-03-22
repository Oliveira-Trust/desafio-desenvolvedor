<?php

declare(strict_types=1);

namespace App\Instrument\Services;

use App\FileUpload\Models\FileUpload;
use App\Instrument\Interfaces\InstrumentRepositoryInterface;
use App\Instrument\Models\Instrument;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\LazyCollection;
use OpenSpout\Reader\XLSX\Options as XlsxOptions;
use OpenSpout\Reader\XLSX\Reader as XlsxReader;

class InstrumentService
{
    public function __construct(
        private readonly InstrumentRepositoryInterface $instrumentRepository,
    ) {}

    public function execute(FileUpload $fileUpload): void
    {
        $fileUpload->update(['status' => 'processing']);

        Cache::flush();

        $path = Storage::path($fileUpload->stored_name);
        $extension = strtolower(pathinfo($fileUpload->original_name, PATHINFO_EXTENSION));
        $totalRows = 0;

        try {
            $rows = match ($extension) {
                'csv' => $this->readCsv($path),
                'xlsx', 'xls' => $this->readXlsx($path),
                default => throw new \RuntimeException("Extensão não suportada: {$extension}"),
            };

            $rows->chunk(500)->each(function ($chunk) use ($fileUpload, &$totalRows) {
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
                ])->values()->toArray();

                Instrument::insert($records);
                $totalRows += count($records);

                unset($records);
                gc_collect_cycles();
            });

            $fileUpload->update(['status' => 'done', 'total_rows' => $totalRows]);

        } catch (\Throwable $e) {
            Log::channel('file_upload')->error('Falha ao processar arquivo', [
                'file_upload_id' => $fileUpload->id,
                'error' => $e->getMessage(),
            ]);

            $fileUpload->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    private function readCsv(string $path): LazyCollection
    {
        return LazyCollection::make(function () use ($path) {
            $handle = fopen($path, 'r');

            if ($handle === false) {
                throw new \RuntimeException("Não foi possível abrir o arquivo: {$path}");
            }

            try {
                $header = null;

                while (($row = fgetcsv($handle, 0, ';')) !== false) {
                    $normalized = array_map(
                        fn ($col) => trim(str_replace("\xEF\xBB\xBF", '', $col ?? '')),
                        $row
                    );

                    if (in_array('RptDt', $normalized)) {
                        $header = $normalized;
                        break;
                    }
                }

                if (! $header) {
                    throw new \RuntimeException('Header RptDt não encontrado no arquivo CSV.');
                }

                while (($row = fgetcsv($handle, 0, ';')) !== false) {
                    if (count($row) === count($header)) {
                        $utf8Row = array_map(fn ($v) => $this->toUtf8($v), $row);
                        yield array_combine($header, $utf8Row);
                    }
                }
            } finally {
                fclose($handle);
            }
        });
    }

    private function readXlsx(string $path): LazyCollection
    {
        return LazyCollection::make(function () use ($path) {
            $reader = new XlsxReader(new XlsxOptions(
                SHOULD_FORMAT_DATES: false,
            ));
            $reader->open($path);

            $header = null;
            $headerSize = 0;

            foreach ($reader->getSheetIterator() as $sheet) {
                foreach ($sheet->getRowIterator() as $row) {
                    $rowData = array_map(
                        fn ($cell) => $this->cellToString($cell),
                        $row->toArray()
                    );

                    if ($header === null) {
                        if (in_array('RptDt', $rowData)) {
                            $header = $rowData;
                            $headerSize = count($header);
                        }

                        continue;
                    }

                    if (empty(array_filter($rowData))) {
                        continue;
                    }

                    $rowData = array_slice(array_pad($rowData, $headerSize, null), 0, $headerSize);
                    $utf8Row = array_map(fn ($v) => $this->toUtf8($v), $rowData);

                    yield array_combine($header, $utf8Row);
                }

                break;
            }

            $reader->close();

            if (! $header) {
                throw new \RuntimeException('Header RptDt não encontrado no arquivo XLSX.');
            }
        });
    }

    private function cellToString(mixed $value): string
    {
        if ($value === null) {
            return '';
        }

        if ($value instanceof \DateTimeInterface) {
            return $value->format('Y-m-d');
        }

        return trim((string) $value);
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
        if ($value === null || $value === '') {
            return $value;
        }

        return mb_check_encoding($value, 'UTF-8')
            ? $value
            : mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
    }
}
