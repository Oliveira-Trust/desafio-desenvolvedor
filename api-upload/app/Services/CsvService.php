<?php
namespace App\Services;

use League\Csv\Reader;
use League\Csv\Statement;
use App\Services\CacheService;

class CsvService
{
    protected $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    public function readCsv($filePath, $delimiter = ';', $headerOffset = 1)
    {
        // Gerar a chave do cache
        $cacheKey = $this->cacheService->generateCacheKey('csv_read', ['file' => $filePath, 'delimiter' => $delimiter, 'headerOffset' => $headerOffset]);

        // Recuperar ou armazenar o conteúdo do CSV no cache
        $csvContent = $this->cacheService->remember($cacheKey, function () use ($filePath) {
            return file_get_contents($filePath);
        });

        // Recriar o objeto Reader a partir do conteúdo do CSV
        $csv = Reader::createFromString($csvContent);
        $csv->setDelimiter($delimiter);
        $csv->setHeaderOffset($headerOffset);

        return $csv;
    }

    public function readAllCsvFiles($directoryPath, $delimiter = ';', $headerOffset = 1)
    {
        $csvReaders = [];
        $files = glob($directoryPath . '/*.csv');

        foreach ($files as $filePath) {
            $csvReaders[] = $this->readCsv($filePath, $delimiter, $headerOffset);
        }

        return $csvReaders;
    }

    public function filterRecords($csv, $filters)
    {
        // Gerar a chave do cache
        $cacheKey = $this->cacheService->generateCacheKey('csv_filter', array_merge(['csv' => $csv->toString()], $filters));

        // Recuperar ou armazenar os registros filtrados no cache
        $filteredRecords = $this->cacheService->remember($cacheKey, function () use ($csv, $filters) {
            $stmt = (new Statement());

            // Aplicar filtros dinamicamente
            if (!empty($filters)) {
                $stmt = $stmt->where(function ($record) use ($filters) {
                    foreach ($filters as $key => $value) {
                        if (!isset($record[$key]) || strpos($record[$key], $value) === false) {
                            return false;
                        }
                    }
                    return true;
                });
            }

            return iterator_to_array($stmt->process($csv));
        });

        return $filteredRecords;
    }
}
