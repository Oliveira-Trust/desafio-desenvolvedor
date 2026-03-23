<?php

namespace Tests\Feature\Upload;

use App\Domains\User\Infrastructure\Persistence\Eloquent\User;
use App\Jobs\ProcessUploadJob;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\Concerns\UsesMySqlDatabase;
use Tests\TestCase;

class RequestCorrelationTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_request_id_is_propagated_to_upload_job_and_response(): void
    {
        Queue::fake();
        Storage::fake('local');

        Sanctum::actingAs(User::factory()->create());

        $response = $this
            ->withHeader('X-Request-Id', 'req-api-123')
            ->post('/api/uploads', [
                'file' => UploadedFile::fake()->create('market-data.csv', 10, 'text/csv'),
            ]);

        $response
            ->assertStatus(202)
            ->assertHeader('X-Request-Id', 'req-api-123')
            ->assertJsonPath('message', 'Upload recebido com sucesso.')
            ->assertJsonPath('data.upload.filename', 'market-data.csv')
            ->assertJsonPath('meta.request_id', 'req-api-123');

        Queue::assertPushed(ProcessUploadJob::class, function (ProcessUploadJob $job): bool {
            return $job->requestId === 'req-api-123';
        });
    }
}
