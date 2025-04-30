<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Jobs\ProcessUploadedFile;

class UploadApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('uploads');
        Queue::fake();
    }

    public function testUnauthenticatedCannotUploadFile()
    {
        $response = $this->postJson('/api/v1/upload', [
            'file' => UploadedFile::fake()->create('test.csv', 100)
        ]);

        $response->assertStatus(401);
    }

    public function testAuthenticatedCanUploadValidCsvFile()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $file = UploadedFile::fake()->createWithContent(
            'financial_data.csv',
            "Date,Symbol,Price\n2023-01-01,AAPL,150.00\n2023-01-02,MSFT,250.00"
        );

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/v1/upload', [
            'file' => $file
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'upload' => [
                    'id',
                    'original_name',
                    'file_name',
                    'file_path',
                    'status',
                    'created_at',
                ]
            ]);

        $uploadedFileName = $response->json('upload.file_path');
        
        Storage::disk('uploads')->assertExists($uploadedFileName);

        Queue::assertPushed(ProcessUploadedFile::class);
    }

    public function testRejectsInvalidFileType()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test-token')->plainTextToken;

        $file = UploadedFile::fake()->createWithContent(
            'document.pdf', 
            "PDF content here"
        );

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/v1/upload', [
            'file' => $file
        ]);

        $response->assertStatus(422);
        
        $response->assertJsonValidationErrors(['file']);

        Queue::assertNotPushed(ProcessUploadedFile::class);
    }
} 