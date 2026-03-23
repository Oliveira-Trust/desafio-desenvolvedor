<?php

namespace Tests\Feature\Queue;

use App\Domains\Upload\Application\Ports\UploadRepository;
use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use App\Jobs\ProcessUploadChunkJob;
use Illuminate\Support\Facades\DB;
use Tests\Concerns\UsesMySqlDatabase;
use Tests\TestCase;

class ChunkIdempotencyTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_chunk_is_processed_only_once_for_the_same_upload_and_index(): void
    {
        $upload = Upload::query()->create([
            'filename' => 'chunk.csv',
            'path' => 'uploads/chunk.csv',
            'mime_type' => 'text/csv',
            'size' => 1,
            'file_md5' => md5('chunk-idempotency.csv'),
            'status' => Upload::STATUS_PROCESSING,
            'rows_total' => 1,
            'processed_rows' => 0,
            'failed_rows' => 0,
        ]);

        $job = new ProcessUploadChunkJob(
            uploadId: $upload->id,
            rows: [$this->validRow()],
            chunkIndex: 0,
            requestId: 'req-idempotency-123',
        );

        $repository = app(UploadRepository::class);

        $job->handle($repository);
        $job->handle($repository);

        $this->assertDatabaseCount('market_data', 1);
        $this->assertDatabaseHas('uploads', [
            'id' => $upload->id,
            'processed_rows' => 1,
            'failed_rows' => 0,
        ]);
        $this->assertSame(1, DB::table('upload_processed_chunks')->count());
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
