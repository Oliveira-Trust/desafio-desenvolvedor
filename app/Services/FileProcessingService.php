<?php declare(strict_types=1);

namespace App\Services;

use App\Models\FileUpload;
use App\Models\Instrument;
use Exception;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;
use PhpOffice\PhpSpreadsheet\IOFactory;
use RuntimeException;

class FileProcessingService
{
    private const int BATCH_SIZE = 500;

    public function process(FileUpload $upload, string $storagePath): void
    {
        $extension = strtolower(pathinfo($upload->original_name, PATHINFO_EXTENSION));

        match ($extension) {
            'csv' => $this->processCsv($upload, $storagePath),
            'xlsx', 'xls' => $this->processExcel($upload, $storagePath),
            default => throw new InvalidArgumentException("Unsupported file type: $extension"),
        };
    }

    private function processCsv(FileUpload $upload, string $path): void
    {
        $handle = fopen($path, 'r');
        if ($handle === false) {
            throw new RuntimeException("Cannot open file: $path");
        }

        try {
            // Remove BOM UTF-8 se presente
            $bom = fread($handle, 3);
            if ($bom !== "\xEF\xBB\xBF") {
                rewind($handle);
            }

            // Lê a primeira linha e detecta o delimitador
            $firstLine = fgets($handle);
            if ($firstLine === false) {
                throw new RuntimeException("Empty file: $path");
            }

            $delimiter = $this->detectDelimiter($firstLine);

            // Se a primeira linha não contiver o delimitador, é metadata — descarta e usa a próxima
            if (substr_count($firstLine, $delimiter) === 0) {
                $firstLine = fgets($handle);
                if ($firstLine === false) {
                    throw new RuntimeException("No header line found");
                }
                $delimiter = $this->detectDelimiter($firstLine);
            }

            $headers = array_map('trim', str_getcsv($firstLine, $delimiter));
            $colCount = count($headers);
            $batch = [];
            $total = 0;

            while (!feof($handle)) {
                $row = $this->readRow($handle, $delimiter, $colCount);
                if ($row === null) {
                    continue;
                }

                $data = array_combine($headers, $row);
                $validated = $this->validateAndTransformRow($data);
                if ($validated === null) {
                    continue;
                }

                $batch[] = $this->mapRow($validated, $upload->id);

                if (count($batch) >= self::BATCH_SIZE) {
                    $this->insertBatch($batch);
                    $total += count($batch);
                    $batch = [];
                    $upload->update(['processed_records' => $total]);
                }
            }

            if (!empty($batch)) {
                $this->insertBatch($batch);
                $total += count($batch);
            }

            $upload->markAsCompleted($total);
        } finally {
            fclose($handle);
        }
    }

    /**
     * Lê e reconecta linhas partidas por \n dentro de campos não-quotados.
     * Tenta até 5 continuações antes de desistir da linha.
     */
    private function readRow($handle, string $delimiter, int $expectedColumns): ?array
    {
        $row = fgetcsv($handle, 0, $delimiter);

        if ($row === false) {
            return null;
        }

        // Tenta reconectar linhas quebradas por \n em campos sem aspas
        $maxContinuations = 5;
        while (count($row) < $expectedColumns && $maxContinuations-- > 0 && !feof($handle)) {
            $continuation = fgetcsv($handle, 0, $delimiter);

            if ($continuation === false) {
                break;
            }

            // Concatena a última coluna incompleta com a primeira da continuação
            $last = array_pop($row);
            $first = array_shift($continuation);
            $row[] = $last . ' ' . $first;
            $row = array_merge($row, $continuation);
        }

        if (count($row) !== $expectedColumns) {
            return null;
        }

        return $row;
    }

    private function processExcel(FileUpload $upload, string $path): void
    {
        $reader = IOFactory::createReaderForFile($path);
        $reader->setReadDataOnly(true);

        $spreadsheet = $reader->load($path);
        $worksheet = $spreadsheet->getActiveSheet();

        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();

        // Read headers from first row
        $headers = array_map('trim', $worksheet->rangeToArray("A1:{$highestColumn}1", null, true, true, false)[0]);

        $batch = [];
        $total = 0;

        for ($rowIndex = 2; $rowIndex <= $highestRow; $rowIndex++) {
            $rowData = $worksheet->rangeToArray("A$rowIndex:$highestColumn$rowIndex", null, true, true, false)[0];

            if (count($rowData) !== count($headers)) {
                continue;
            }

            $data = array_combine($headers, $rowData);
            $validated = $this->validateAndTransformRow($data);
            if ($validated === null) {
                continue;
            }

            $batch[] = $this->mapRow($validated, $upload->id);

            if (count($batch) >= self::BATCH_SIZE) {
                $this->insertBatch($batch);
                $total += count($batch);
                $batch = [];
                $upload->update(['processed_records' => $total]);
            }
        }

        if (!empty($batch)) {
            $this->insertBatch($batch);
            $total += count($batch);
        }

        $upload->markAsCompleted($total);
    }

    // ── Validation & Transformation ───────────────────────────────────────────

    /**
     * Validate and transform a single row.
     * Returns the transformed array or null if invalid.
     */
    private function validateAndTransformRow(array $row): ?array
    {
        $required = ['RptDt', 'TckrSymb'];
        foreach ($required as $field) {
            if (empty($row[$field])) {
                return null;
            }
        }

        $row['RptDt'] = date('Y-m-d', strtotime($row['RptDt']));
        if ($row['RptDt'] === '1970-01-01') {
            return null;
        }

        foreach ($row as $key => $value) {
            if (is_string($value)) {
                $value = mb_convert_encoding($value, 'UTF-8', 'ISO-8859-1');
                $row[$key] = trim(preg_replace('/[\r\n]+/', ' ', $value));
            }
        }

        return $row;
    }


    private function mapRow(array $row, string $fileUploadId): array
    {
        $mapped = ['file_upload_id' => $fileUploadId];

        foreach ($row as $key => $value) {
            $mapped[trim($key)] = is_string($value) ? trim($value) : $value;
        }

        $mapped['created_at'] = now();
        $mapped['updated_at'] = now();

        return $mapped;
    }

    // ── Batch Insert with Error Handling ──────────────────────────────────────

    private function insertBatch(array $batch): void
    {
        foreach ($batch as $item) {
            try {
                Instrument::create($item);
            } catch (Exception $e) {
                Log::warning("Row insert failed, skipping", [
                    'ticker' => $item['TckrSymb'] ?? '?',
                    'error' => $e->getMessage(),
                ]);
            }
        }
    }

    private function detectDelimiter(string $line): string
    {
        $delimiters = [',', ';', "\t", '|'];
        $counts = array_map(fn($d) => substr_count($line, $d), $delimiters);
        $maxCount = max($counts);

        if ($maxCount === 0) {
            return ',';
        }

        return $delimiters[array_search($maxCount, $counts)];
    }

    public function extractReferenceDate(string $filename): ?string
    {
        if (preg_match('/(\d{8})/', $filename, $matches)) {
            $raw = $matches[1];
            return substr($raw, 0, 4) . '-' . substr($raw, 4, 2) . '-' . substr($raw, 6, 2);
        }
        return null;
    }

    public function hashFile(string $path): string
    {
        return hash_file('sha256', $path);
    }
}
