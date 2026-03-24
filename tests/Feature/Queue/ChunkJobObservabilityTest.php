<?php

namespace Tests\Feature\Queue;

use App\Domains\Upload\Application\Ports\UploadRepository;
use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use App\Jobs\ProcessUploadChunkJob;
use Illuminate\Support\Facades\Log;
use Tests\Concerns\UsesMySqlDatabase;
use Tests\TestCase;

class ChunkJobObservabilityTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_chunk_job_emits_structured_logs_with_request_correlation(): void
    {
        $upload = Upload::query()->create([
            'filename' => 'chunk.csv',
            'path' => 'uploads/chunk.csv',
            'mime_type' => 'text/csv',
            'size' => 1,
            'file_md5' => md5('chunk.csv'),
            'status' => Upload::STATUS_PENDING,
            'rows_total' => 0,
            'processed_rows' => 0,
            'failed_rows' => 0,
        ]);

        $job = new ProcessUploadChunkJob(
            uploadId: $upload->id,
            rows: [$this->validRow()],
            chunkIndex: 2,
            requestId: 'req-observability-123',
        );

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function (string $message, array $context): bool {
                return $message === 'ingestion.upload_chunk.started'
                    && $context['request_id'] === 'req-observability-123'
                    && $context['upload_id'] > 0
                    && $context['chunk'] === 2
                    && $context['status'] === 'processing'
                    && is_int($context['duration_ms']);
            });

        Log::shouldReceive('info')
            ->once()
            ->withArgs(function (string $message, array $context): bool {
                return $message === 'ingestion.upload_chunk.completed'
                    && $context['request_id'] === 'req-observability-123'
                    && $context['upload_id'] > 0
                    && $context['chunk'] === 2
                    && $context['status'] === 'completed'
                    && $context['processed_rows'] === 1
                    && $context['failed_rows'] === 0
                    && is_int($context['duration_ms']);
            });

        $job->handle(app(UploadRepository::class));
    }

    /**
     * @return array<int, mixed>
     */
    private function validRow(): array
    {
        return [
            '2026-03-23',
            'PETR4',
            null,
            null,
            null,
            'BOVESPA',
            'ACOES',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            'BRPETRACNPR6',
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            'PETROLEO BRASILEIRO SA',
        ];
    }
}
