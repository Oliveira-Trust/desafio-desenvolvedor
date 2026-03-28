<?php declare(strict_types=1);

namespace Tests\Feature;

use App\Jobs\ProcessInstrumentFile;
use App\Models\FileUpload;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Tests\Traits\RefreshMongoDatabase;

class FileUploadTest extends TestCase
{
    use RefreshMongoDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
        Queue::fake();

        FileUpload::query()->delete();

        $this->user = User::factory()->create();
    }

    protected function actingAsJwt(User $user): FileUploadTest
    {
        $token = auth('api')->login($user);

        return $this->withHeader('Authorization', "Bearer {$token}");
    }

    // ── Upload ────────────────────────────────────────────────────────────────

    public function test_authenticated_user_can_upload_csv(): void
    {
        $file = UploadedFile::fake()->createWithContent(
            'InstrumentsFile_20240822.csv',
            $this->sampleCsv()
        );

        $response = $this->actingAsJwt($this->user)
            ->postJson('/api/files', ['file' => $file]);

        $response->assertAccepted()
            ->assertJsonStructure([
                'message',
                'data' => ['id', 'original_name', 'status', 'reference_date'],
            ]);

        $this->assertSame('pending', $response->json('data.status'));
        $this->assertSame('2024-08-22', $response->json('data.reference_date'));

        Queue::assertPushed(ProcessInstrumentFile::class);
    }

    public function test_authenticated_user_can_upload_xlsx(): void
    {
        $file = UploadedFile::fake()->create(
            'instruments_20240822.xlsx',
            100,
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        );

        $this->actingAsJwt($this->user)
            ->postJson('/api/files', ['file' => $file])
            ->assertAccepted();

        Queue::assertPushed(ProcessInstrumentFile::class);
    }

    public function test_duplicate_file_is_rejected(): void
    {
        $content = $this->sampleCsv();
        $hash = hash('sha256', $content);

        FileUpload::create([
            'original_name' => 'original.csv',
            'stored_name' => 'stored.csv',
            'hash' => $hash,
            'status' => FileUpload::STATUS_COMPLETED,
            'total_records' => 5,
            'processed_records' => 5,
            'uploaded_by' => (string)$this->user->id,
        ]);

        $file = UploadedFile::fake()->createWithContent('duplicate.csv', $content);

        $this->actingAsJwt($this->user)
            ->postJson('/api/files', ['file' => $file])
            ->assertUnprocessable()
            ->assertJson(['message' => 'Este arquivo já foi enviado anteriormente.']);

        Queue::assertNothingPushed();
    }

    public function test_upload_rejects_unsupported_file_type(): void
    {
        $file = UploadedFile::fake()->create('report.pdf', 100, 'application/pdf');

        $this->actingAsJwt($this->user)
            ->postJson('/api/files', ['file' => $file])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['file']);
    }

    public function test_upload_requires_file_field(): void
    {
        $this->actingAsJwt($this->user)
            ->postJson('/api/files', [])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['file']);
    }

    public function test_upload_requires_authentication(): void
    {
        $file = UploadedFile::fake()->create('file.csv', 10, 'text/csv');

        $this->postJson('/api/files', ['file' => $file])
            ->assertUnauthorized();
    }

    // ── History ───────────────────────────────────────────────────────────────

    public function test_user_can_list_upload_history(): void
    {
        $this->seedUploads();

        $this->actingAsJwt($this->user)
            ->getJson('/api/files')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [['id', 'original_name', 'status']],
                'meta' => ['current_page', 'total'],
            ]);
    }

    public function test_history_can_be_filtered_by_name(): void
    {
        FileUpload::create($this->uploadData(['original_name' => 'InstrumentsFile_20240822.csv']));
        FileUpload::create($this->uploadData(['original_name' => 'OtherFile_20240823.csv']));

        $response = $this->actingAsJwt($this->user)
            ->getJson('/api/files?name=Instruments')
            ->assertOk();

        $this->assertEquals(1, $response->json('meta.total'));
    }

    public function test_history_can_be_filtered_by_reference_date(): void
    {
        FileUpload::create($this->uploadData(['reference_date' => '2024-08-22']));
        FileUpload::create($this->uploadData(['reference_date' => '2024-08-23']));

        $response = $this->actingAsJwt($this->user)
            ->getJson('/api/files?reference_date=2024-08-22')
            ->assertOk();

        $this->assertEquals(1, $response->json('meta.total'));
    }

    public function test_history_is_paginated(): void
    {
        $this->seedUploads(20);

        $this->actingAsJwt($this->user)
            ->getJson('/api/files?per_page=5')
            ->assertOk()
            ->assertJsonPath('meta.per_page', 5)
            ->assertJsonPath('meta.total', 20);
    }

    // ── Show ──────────────────────────────────────────────────────────────────

    public function test_user_can_show_single_upload(): void
    {
        $upload = FileUpload::create($this->uploadData());

        $this->actingAsJwt($this->user)
            ->getJson("/api/files/{$upload->_id}")
            ->assertOk()
            ->assertJsonPath('data.id', (string)$upload->_id);
    }

    public function test_show_returns_404_for_unknown_id(): void
    {
        $this->actingAsJwt($this->user)
            ->getJson('/api/files/000000000000000000000000')
            ->assertNotFound();
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    private function sampleCsv(): string
    {
        return <<<CSV
            header1,header2
            value1,value2
            value3,value4
        CSV;
    }

    private function uploadData(array $overrides = []): array
    {
        static $i = 0;
        $i++;

        return array_merge([
            'original_name' => "file_{$i}.csv",
            'stored_name' => "stored_{$i}.csv",
            'hash' => hash('sha256', "content_{$i}"),
            'status' => FileUpload::STATUS_COMPLETED,
            'reference_date' => '2024-08-22',
            'total_records' => 100,
            'processed_records' => 100,
            'uploaded_by' => (string)$this->user->id,
        ], $overrides);
    }

    private function seedUploads(int $count = 5): void
    {
        for ($i = 0; $i < $count; $i++) {
            FileUpload::create($this->uploadData());
        }
    }
}
