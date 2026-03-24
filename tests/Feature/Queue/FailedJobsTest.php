<?php

namespace Tests\Feature\Queue;

use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use App\Jobs\ProcessUploadJob;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\Concerns\UsesMySqlDatabase;

class FailedJobsTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_process_upload_job_is_recorded_in_failed_jobs_after_final_failure(): void
    {
        Storage::fake('local');

        $upload = Upload::query()->create([
            'filename' => 'missing.csv',
            'path' => 'uploads/missing.csv',
            'mime_type' => 'text/csv',
            'size' => 1,
            'file_md5' => md5('missing.csv'),
            'status' => Upload::STATUS_PENDING,
            'rows_total' => 0,
            'processed_rows' => 0,
            'failed_rows' => 0,
        ]);

        ProcessUploadJob::dispatch($upload->id);

        Artisan::call('queue:work', [
            'connection' => 'database',
            '--queue' => 'ingestion',
            '--once' => true,
            '--tries' => 1,
        ]);

        $this->assertDatabaseCount('failed_jobs', 1);
        $this->assertDatabaseHas('failed_jobs', [
            'queue' => 'ingestion',
        ]);
        $this->assertDatabaseHas('uploads', [
            'id' => $upload->id,
            'status' => Upload::STATUS_FAILED,
            'error_message' => 'Arquivo do upload nao encontrado.',
        ]);
    }
}
