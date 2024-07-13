<?php

declare(strict_types=1);

namespace App\Services\Patterns;

use Illuminate\Support\Facades\Storage;

class ExcelFacade
{
    public function csv(array $data, string $fileName, string $delimiter = ';'): bool
    {
        $columns = $data['columns'] ?? [];
        $rows = $data['rows'] ?? [];

        $lines = trim(implode($delimiter, $columns)) . PHP_EOL;

        foreach ($rows as $row) {
            if(is_array($row)) {
                $lines .= trim(implode($delimiter, $row)) . PHP_EOL;
            }
        }

        return Storage::disk('exports')->put($fileName, $lines);
    }
}
