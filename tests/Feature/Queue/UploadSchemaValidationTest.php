<?php

namespace Tests\Feature\Queue;

use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use App\Jobs\ProcessUploadJob;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\Concerns\UsesMySqlDatabase;
use Tests\TestCase;

class UploadSchemaValidationTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_upload_fails_when_file_header_is_invalid(): void
    {
        Storage::fake('local');

        $invalidFile = implode("\n", [
            'Status do Arquivo: Final',
            'WrongCol;Ticker;MktNm;SctyCtgyNm;ISIN;CrpnNm',
            '2026-03-23;PETR4;BOVESPA;ACOES;BRPETRACNPR6;PETROLEO BRASILEIRO SA',
        ]);

        Storage::disk('local')->put('uploads/invalid-schema.csv', $invalidFile);

        $upload = Upload::query()->create([
            'filename' => 'invalid-schema.csv',
            'path' => 'uploads/invalid-schema.csv',
            'mime_type' => 'text/csv',
            'size' => strlen($invalidFile),
            'file_md5' => md5($invalidFile),
            'status' => Upload::STATUS_PENDING,
            'rows_total' => 0,
            'processed_rows' => 0,
            'failed_rows' => 0,
        ]);

        ProcessUploadJob::dispatch($upload->id, 'req-schema-123');

        Artisan::call('queue:work', [
            'connection' => 'database',
            '--queue' => 'ingestion',
            '--once' => true,
            '--tries' => 1,
        ]);

        $this->assertDatabaseCount('failed_jobs', 1);
        $this->assertDatabaseHas('uploads', [
            'id' => $upload->id,
            'status' => Upload::STATUS_FAILED,
            'reference_date' => null,
            'error_message' => 'Header do arquivo invalido.',
        ]);
    }

    public function test_upload_accepts_supported_fixed_header_positions(): void
    {
        Storage::fake('local');

        $headerRow = array_fill(0, 48, '');
        $headerRow[0] = 'RptDt';
        $headerRow[1] = 'TckrSymb';
        $headerRow[5] = 'MktNm';
        $headerRow[6] = 'SctyCtgyNm';
        $headerRow[15] = 'ISIN';
        $headerRow[47] = 'CrpnNm';

        $validFile = implode("\n", [
            'Status do Arquivo: Final',
            implode(';', $headerRow),
        ]);

        Storage::disk('local')->put('uploads/fixed-header.csv', $validFile);

        $upload = Upload::query()->create([
            'filename' => 'fixed-header.csv',
            'path' => 'uploads/fixed-header.csv',
            'mime_type' => 'text/csv',
            'size' => strlen($validFile),
            'file_md5' => md5($validFile),
            'status' => Upload::STATUS_PENDING,
            'rows_total' => 0,
            'processed_rows' => 0,
            'failed_rows' => 0,
        ]);

        $job = new ProcessUploadJob($upload->id, 'req-fixed-header-123');
        $job->handle(app(\App\Domains\Upload\Application\Ports\UploadRepository::class));

        $this->assertDatabaseHas('uploads', [
            'id' => $upload->id,
            'status' => Upload::STATUS_COMPLETED,
            'rows_total' => 0,
            'error_message' => null,
        ]);
        $this->assertDatabaseCount('failed_jobs', 0);
    }
}
