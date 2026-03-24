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

class UploadValidationTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_upload_accepts_xls_files(): void
    {
        Queue::fake();
        Storage::fake('local');

        Sanctum::actingAs(User::factory()->create());

        $response = $this->post('/api/uploads', [
            'file' => UploadedFile::fake()->create('market-data.xls', 10, 'application/vnd.ms-excel'),
        ]);

        $response
            ->assertStatus(202);

        Queue::assertPushed(ProcessUploadJob::class);
    }
}
