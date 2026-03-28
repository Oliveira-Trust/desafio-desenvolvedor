<?php

namespace Tests\Feature;

use App\Models\UploadHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\Attributes\SetUp;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class UploadHistoryTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        Cache::tags(['instruments_history'])->flush();
    }

    public function test_user_can_list_upload_history_whith_cache(): void
    {
        $user = User::factory()->create();
        UploadHistory::factory()->count(5)->create();

        $response1 = $this->actingAs($user)->getJson("/api/v1/uploads");
        $response1->assertStatus(200)
                        ->assertJsonCount(5, 'data');
    }

    public function test_whether_upload_history_returns_correctly_using_filter_file_name(): void
    {
        $user = User::factory()->create();
        UploadHistory::factory()->create(['file_name' => "report.csv", 'reference_date' => '2026-03-24']);
        UploadHistory::factory()->create(['file_name' => "Instruments_b3_2025.csv", 'reference_date' => '2025-05-19']);
        
        $response1 = $this->actingAs($user)->getJson("/api/v1/uploads?file_name=report");
        $response1->assertStatus(200)
                        ->assertJsonCount(1, 'data')
                        ->assertJsonPath('data.0.file_name', 'report.csv');

        $response2 = $this->actingAs($user)->getJson("/api/v1/uploads?file_name=Instruments_b3_2025");
        $response2->assertStatus(200)
                        ->assertJsonCount(1, 'data')
                        ->assertJsonPath('data.0.file_name', 'Instruments_b3_2025.csv');

        $response3 = $this->actingAs($user)->getJson("/api/v1/uploads?file_name=test");
        $response3->assertStatus(200)
                        ->assertJsonCount(0, 'data');
    }

    public function test_whether_upload_history_returns_correctly_using_filter_reference_date(): void
    {
        $user = User::factory()->create();
        $date1 = date('2026-03-24');
        $date2 = date('2025-05-19');
        $date3 = date('2025-05-10');

        UploadHistory::factory()->create(['file_name' => "report.csv", 'reference_date' => $date1]);
        UploadHistory::factory()->create(['file_name' => "Instruments_b3_2025.csv", 'reference_date' => $date2]);

        $response1 = $this->actingAs($user)->getJson("/api/v1/uploads?reference_date=$date1");
        $response1->assertStatus(200)
                        ->assertJsonCount(1, 'data')
                        ->assertJsonPath('data.0.file_name', 'report.csv');

        $response2 = $this->actingAs($user)->getJson("/api/v1/uploads?reference_date=$date2");
        $response2->assertStatus(200)
                        ->assertJsonCount(1, 'data')
                        ->assertJsonPath('data.0.file_name', 'Instruments_b3_2025.csv');

        $response3 = $this->actingAs($user)->getJson("/api/v1/uploads?reference_date=$date3");
        $response3->assertStatus(200)
                        ->assertJsonCount(0, 'data');
    }

    public function test_it_fails_if_reference_date_format_is_invalid(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson("/api/v1/uploads?reference_date=24-03-2026");

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['reference_date']);
    }


}
