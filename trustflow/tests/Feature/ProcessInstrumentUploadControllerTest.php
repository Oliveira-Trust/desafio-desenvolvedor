<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProcessInstrumentUploadControllerTest extends TestCase
{
    use RefreshDatabase;    

    public function test_authenticated_user_can_upload_instruments_file(): void
    {
        Storage::fake('local');
        Bus::fake();

        $user = User::factory()->create();

        $file = UploadedFile::fake()->create('instruments.csv', 100);
        $referenceDate = date('Y-m-d');

        $response = $this->actingAs($user)
                        ->post('/api/v1/upload', ['file' => $file, 'reference_date' => $referenceDate]);
        
        $response->assertStatus(202)
            ->assertJsonStructure(["message"]);

        Storage::disk('local')->assertExists('uploads/' . time() . 'instruments.csv');
        $this->assertCount(1, Storage::disk('local')->files('uploads'));

        $this->assertDatabaseHas('upload_histories', [
            'user_id' => $user->id,
            'status' => 'pending',
            'file_name' => 'instruments.csv' 
        ]);

        Bus::assertChained([
            \App\Jobs\ProcessInstrumentUpload::class,
            \App\Jobs\SendEmailInstrumentsJob::class
        ]);
    }

    public function tests_whether_a_user_who_is_not_logged_in_can_upload(): void
    {
        $file = UploadedFile::fake()->create('instruments.csv', 100);
        $referenceDate = date('Y-m-d');

        $response = $this->post('/api/v1/upload', ['file' => $file, 'reference_date' => $referenceDate]);

        $response->assertStatus(401)->assertJson([
            "error" => "Not Authenticated",
            "message" => "Token is missing or invalid."
        ]);
    }

    public function test_upload_requires_a_file(): void
    {
        $referenceDate = date('Y-m-d');

        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/v1/upload', ['reference_date' => $referenceDate]);

        $response->assertStatus(422)->assertJsonValidationErrors(['file']);
    }

    public function test_upload_requires_a_reference_date(): void
    {
        $file = UploadedFile::fake()->create('instruments.csv', 100);

        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('/api/v1/upload', ['file' => $file]);

        $response->assertStatus(422)->assertJsonValidationErrors(['reference_date']);
    }

    public function test_cannot_upload_same_file_twice(): void
    {
        Storage::fake('local');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('instruments.csv', 100);
        $referenceDate = date('Y-m-d');

        $this->actingAs($user)
                ->post('/api/v1/upload', ['file' => $file, 'reference_date' => $referenceDate]);

        $response = $this->actingAs($user)
                ->post('/api/v1/upload', ['file' => $file, 'reference_date' => $referenceDate]);

        $response->assertStatus(422)
                    ->assertJson([
                        "message" => "File already processed previously."
                    ]);
    }

    public function test_upload_rejects_invalid_file_extensions(): void
    {
        Storage::fake('local');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('virus.pdf', 100);
        $referenceDate = date('Y-m-d');

        $response = $this->actingAs($user)
                ->post('/api/v1/upload', ['file' => $file, 'reference_date' => $referenceDate]);
        
        $response->assertStatus(422)
             ->assertJsonValidationErrors(['file']);
    }

    public function test_upload_rejects_files_too_large(): void
    {
        Storage::fake('local');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('virus.pdf', 153600);
        $referenceDate = date('Y-m-d');

        $response = $this->actingAs($user)
                ->post('/api/v1/upload', ['file' => $file, 'reference_date' => $referenceDate]);
        
        $response->assertStatus(422)
             ->assertJsonValidationErrors(['file']);
    }

    public function test_upload_rejects_invalid_date_format(): void
    {
        Storage::fake('local');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->create('virus.pdf', 153600);
        $referenceDate = date('d/m/Y');

        $response = $this->actingAs($user)
                ->post('/api/v1/upload', ['file' => $file, 'reference_date' => $referenceDate]);
        
        $response->assertStatus(422)
             ->assertJsonValidationErrors(['reference_date']);
    }
}
