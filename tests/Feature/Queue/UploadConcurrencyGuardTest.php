<?php

namespace Tests\Feature\Queue;

use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use App\Jobs\ProcessUploadJob;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Tests\Concerns\UsesMySqlDatabase;
use Tests\TestCase;

class UploadConcurrencyGuardTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_upload_is_not_reprocessed_when_status_is_not_pending(): void
    {
        Storage::fake('local');

        $upload = Upload::query()->create([
            'filename' => 'already-processing.csv',
            'path' => 'uploads/already-processing.csv',
            'mime_type' => 'text/csv',
            'size' => 1,
            'file_md5' => md5('already-processing.csv'),
            'status' => Upload::STATUS_PROCESSING,
            'rows_total' => 25,
            'processed_rows' => 10,
            'failed_rows' => 1,
        ]);

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function (string $message, array $context) use ($upload): bool {
                return $message === 'ingestion.upload.started'
                    && $context['upload_id'] === $upload->id
                    && $context['status'] === 'processing';
            });

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function (string $message, array $context) use ($upload): bool {
                return $message === 'ingestion.upload.skipped'
                    && $context['upload_id'] === $upload->id
                    && $context['status'] === 'skipped'
                    && $context['reason'] === 'upload_already_processing_or_processed';
            });

        $job = new ProcessUploadJob($upload->id, 'req-concurrency-123');
        $job->handle(app(\App\Domains\Upload\Application\Ports\UploadRepository::class));

        $this->assertDatabaseHas('uploads', [
            'id' => $upload->id,
            'status' => Upload::STATUS_PROCESSING,
            'rows_total' => 25,
            'processed_rows' => 10,
            'failed_rows' => 1,
        ]);
    }
}
