<?php

namespace Tests\Feature\Queue;

use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use App\Jobs\ProcessUploadJob;
use Illuminate\Support\Facades\Storage;
use Tests\Concerns\UsesMySqlDatabase;
use Tests\TestCase;

class UploadReferenceDatePersistenceTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_process_upload_job_persists_reference_date_from_file_data(): void
    {
        Storage::fake('local');

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

        $file = implode("\n", [
            'Status do Arquivo: Final',
            implode(';', $headerRow),
            implode(';', $dataRow),
        ]);

        Storage::disk('local')->put('uploads/reference-date.csv', $file);

        $upload = Upload::query()->create([
            'filename' => 'reference-date.csv',
            'path' => 'uploads/reference-date.csv',
            'mime_type' => 'text/csv',
            'size' => strlen($file),
            'file_md5' => md5($file),
            'status' => Upload::STATUS_PENDING,
            'rows_total' => 0,
            'processed_rows' => 0,
            'failed_rows' => 0,
        ]);

        $job = new ProcessUploadJob($upload->id, 'req-reference-date-123');
        $job->handle(app(\App\Domains\Upload\Application\Ports\UploadRepository::class));

        $this->assertDatabaseHas('uploads', [
            'id' => $upload->id,
            'reference_date' => '2026-03-23',
        ]);
    }
}
