<?php

namespace Tests\Feature\Queue;

use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use App\Jobs\ProcessUploadJob;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FailedJobsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('database.default', 'mysql');
        config()->set('database.connections.mysql.host', env('DB_HOST', 'mysql'));
        config()->set('database.connections.mysql.port', (int) env('DB_PORT', 3306));
        config()->set('database.connections.mysql.database', 'desafio-ot');
        config()->set('database.connections.mysql.username', 'ot');
        config()->set('database.connections.mysql.password', 'password');
        config()->set('queue.default', 'database');
        config()->set('queue.failed.database', 'mysql');

        Artisan::call('migrate:fresh', ['--database' => 'mysql']);
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
