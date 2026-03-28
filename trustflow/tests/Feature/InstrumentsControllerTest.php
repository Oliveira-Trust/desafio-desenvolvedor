<?php

namespace Tests\Feature;

use App\Models\Instrument;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class InstrumentsControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::tags(["instruments_data"])->flush();
    }


    public function test_user_can_list_instruments_whith_cache(): void
    {
        $user = User::factory()->create();
        Instrument::factory()->count(100)->create();

        $response1 = $this->actingAs($user)->getJson("/api/v1/instruments");
        $response1->assertStatus(200)
            ->assertJsonStructure(['current_page', 'data', 'total'])
            ->assertJsonCount(10, 'data');
    }

    public function test_user_can_list_instruments_whith_filters(): void
    {
        $user = User::factory()->create();
        $dates = $this->createInstruments();

        // no filters
        $response1 = $this->actingAs($user)->getJson("/api/v1/instruments");
        $response1->assertStatus(200)
            ->assertJsonStructure(['current_page', 'data', 'total'])
            ->assertJsonCount(10, 'data');
        
        // using TckrSymb filter
        $response2 = $this->actingAs($user)->getJson("/api/v1/instruments?RptDt={$dates['dt1']}");
        $response2->assertStatus(200)
            ->assertJsonStructure(['current_page', 'data', 'total'])
            ->assertJsonCount(9, 'data');

        $dataResponse2 = $response2->json('data');
        foreach ($dataResponse2 as $item) {
            $this->assertEquals($dates['dt1'], $item['RptDt']);
        }
        
        // using RptDt filter
        $response3 = $this->actingAs($user)->getJson("/api/v1/instruments?RptDt={$dates['dt2']}");
        $response3->assertStatus(200)
            ->assertJsonStructure(['current_page', 'data', 'total'])
            ->assertJsonCount(10, 'data')
            ->assertJsonPath('data.0.RptDt', $dates['dt2']);

        $dataResponse3 = $response3->json('data');
        foreach ($dataResponse3 as $item) {
            $this->assertEquals($dates['dt2'], $item['RptDt']);
        }


        // using format filter = full
        $response3 = $this->actingAs($user)->getJson("/api/v1/instruments?TckrSymb=PETR4&format=full");
        $response3->assertStatus(200)
            ->assertJsonStructure(['current_page', 'data', 'total'])
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.TckrSymb', 'PETR4')
            ->assertJsonCount(56, 'data.0');
        
        // using format filter = summary
        $response3 = $this->actingAs($user)->getJson("/api/v1/instruments?TckrSymb=PETR4&format=summary");
        $response3->assertStatus(200)
            ->assertJsonStructure(['current_page', 'data', 'total'])
            ->assertJsonCount(1, 'data')
            ->assertJsonPath('data.0.TckrSymb', 'PETR4')
            ->assertJsonCount(6, 'data.0');

    }

    public function test_it_fails_if_reference_date_format_is_invalid(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->getJson("/api/v1/instruments?RptDt=24-03-2026");

        $response->assertStatus(422)
                ->assertJsonValidationErrors(['RptDt']);
    }

    public function createInstruments(): array{
        $date1 = date('2026-03-25');
        $date2 = date('2026-03-19');

        Instrument::factory()->create(['TckrSymb' => 'PETR4', 'RptDt' => $date1]);
        Instrument::factory()->create(['TckrSymb' => 'PETR3', 'RptDt' => $date1]);
        Instrument::factory()->create(['TckrSymb' => 'VALE3', 'RptDt' => $date1]);
        Instrument::factory()->create(['TckrSymb' => 'ITUB4', 'RptDt' => $date1]);
        Instrument::factory()->create(['TckrSymb' => 'BBDC4', 'RptDt' => $date1]);
        Instrument::factory()->create(['TckrSymb' => 'BBAS3', 'RptDt' => $date1]);
        Instrument::factory()->create(['TckrSymb' => 'ABEV3', 'RptDt' => $date1]);
        Instrument::factory()->create(['TckrSymb' => 'WEGE3', 'RptDt' => $date1]);
        Instrument::factory()->create(['TckrSymb' => 'RENT3', 'RptDt' => $date1]);
        Instrument::factory()->create(['TckrSymb' => 'MGLU3', 'RptDt' => $date2]);
        Instrument::factory()->create(['TckrSymb' => 'B3SA3', 'RptDt' => $date2]);
        Instrument::factory()->create(['TckrSymb' => 'EQTL3', 'RptDt' => $date2]);
        Instrument::factory()->create(['TckrSymb' => 'SUZB3', 'RptDt' => $date2]);
        Instrument::factory()->create(['TckrSymb' => 'RADL3', 'RptDt' => $date2]);
        Instrument::factory()->create(['TckrSymb' => 'HAPV3', 'RptDt' => $date2]);
        Instrument::factory()->create(['TckrSymb' => 'JBSS3', 'RptDt' => $date2]);
        Instrument::factory()->create(['TckrSymb' => 'UGPA3', 'RptDt' => $date2]);
        Instrument::factory()->create(['TckrSymb' => 'GGBR4', 'RptDt' => $date2]);
        Instrument::factory()->create(['TckrSymb' => 'BRKM5', 'RptDt' => $date2]);
        Instrument::factory()->create(['TckrSymb' => 'CMIG4', 'RptDt' => $date2]);

        return ['dt1' => $date1, 'dt2' => $date2];
    }
}
