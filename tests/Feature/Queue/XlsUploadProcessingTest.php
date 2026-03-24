<?php

namespace Tests\Feature\Queue;

use App\Jobs\ProcessUploadJob;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Tests\TestCase;

class XlsUploadProcessingTest extends TestCase
{
    public function test_process_upload_job_can_read_rows_from_xls_files(): void
    {
        $absolutePath = sys_get_temp_dir() . '/valid-market-data.xls';

        $this->createValidXlsFile($absolutePath);

        $job = new ProcessUploadJob(1, 'req-xls-123');
        $method = new \ReflectionMethod(ProcessUploadJob::class, 'readRows');
        $method->setAccessible(true);

        $rows = iterator_to_array($method->invoke($job, $absolutePath), false);

        $this->assertCount(3, $rows);
        $this->assertSame('Status do Arquivo: Final', $rows[0][0]);
        $this->assertSame('RptDt', $rows[1][0]);
        $this->assertSame('TckrSymb', $rows[1][1]);
        $this->assertSame('CrpnNm', $rows[1][47]);
        $this->assertSame('2026-03-23', $rows[2][0]);
        $this->assertSame('PETR4', $rows[2][1]);
        $this->assertSame('PETROLEO BRASILEIRO SA', $rows[2][47]);

        @unlink($absolutePath);
    }

    private function createValidXlsFile(string $absolutePath): void
    {
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->getActiveSheet();

        $statusRow = ['Status do Arquivo: Final'];
        $headerRow = array_fill(0, 48, '');
        $dataRow = array_fill(0, 48, '');

        $headerRow[0] = 'RptDt';
        $headerRow[1] = 'TckrSymb';
        $headerRow[5] = 'MktNm';
        $headerRow[6] = 'SctyCtgyNm';
        $headerRow[15] = 'ISIN';
        $headerRow[47] = 'CrpnNm';

        $dataRow[0] = '2026-03-23';
        $dataRow[1] = 'PETR4';
        $dataRow[5] = 'BOVESPA';
        $dataRow[6] = 'ACOES';
        $dataRow[15] = 'BRPETRACNPR6';
        $dataRow[47] = 'PETROLEO BRASILEIRO SA';

        $worksheet->fromArray($statusRow, null, 'A1');
        $worksheet->fromArray($headerRow, null, 'A2');
        $worksheet->fromArray($dataRow, null, 'A3');

        $writer = new Xls($spreadsheet);
        $writer->save($absolutePath);
        $spreadsheet->disconnectWorksheets();
    }
}
