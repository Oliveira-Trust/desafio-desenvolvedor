<?php declare(strict_types=1);

use App\Models\Instrument;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Tests\Traits\RefreshMongoDatabase;

class InstrumentSearchTest extends TestCase
{
    use RefreshMongoDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();

        $this->user = User::factory()->create();

        $this->seedInstruments();
    }

    // ── Search ────────────────────────────────────────────────────────────────

    public function test_returns_paginated_results_without_filters(): void
    {
        $response = $this->actingAsJwt($this->user)
            ->getJson('/api/instruments')
            ->assertOk()
            ->assertJsonStructure([
                'data' => [[
                    'RptDt', 'TckrSymb', 'MktNm',
                    'SctyCtgyNm', 'ISIN', 'CrpnNm',
                ]],
                'links',
                'meta' => ['current_page', 'total', 'per_page'],
            ]);

        $this->assertGreaterThan(0, $response->json('meta.total'));
    }

    public function test_can_filter_by_ticker_symbol(): void
    {
        $response = $this->actingAsJwt($this->user)
            ->getJson('/api/instruments?TckrSymb=AMZO34')
            ->assertOk();

        $data = $response->json('data');

        $this->assertNotEmpty($data);

        foreach ($data as $item) {
            $this->assertSame('AMZO34', $item['TckrSymb']);
        }
    }

    public function test_ticker_filter_is_case_insensitive(): void
    {
        $this->actingAsJwt($this->user)
            ->getJson('/api/instruments?TckrSymb=amzo34')
            ->assertOk()
            ->assertJsonPath('meta.total', fn($total) => $total > 0);
    }

    public function test_can_filter_by_report_date(): void
    {
        $response = $this->actingAsJwt($this->user)
            ->getJson('/api/instruments?RptDt=2024-08-22')
            ->assertOk();

        foreach ($response->json('data') as $item) {
            $this->assertSame('2024-08-22', $item['RptDt']);
        }
    }

    public function test_can_filter_by_both_ticker_and_date(): void
    {
        $response = $this->actingAsJwt($this->user)
            ->getJson('/api/instruments?TckrSymb=AMZO34&RptDt=2024-08-26')
            ->assertOk();

        $data = $response->json('data');
        $this->assertCount(1, $data);
        $this->assertSame('AMZO34', $data[0]['TckrSymb']);
        $this->assertSame('2024-08-26', $data[0]['RptDt']);
    }

    public function test_returns_empty_data_for_unknown_ticker(): void
    {
        $this->actingAsJwt($this->user)
            ->getJson('/api/instruments?TckrSymb=XXXX99')
            ->assertOk()
            ->assertJsonPath('meta.total', 0);
    }

    public function test_invalid_date_format_returns_validation_error(): void
    {
        $this->actingAsJwt($this->user)
            ->getJson('/api/instruments?RptDt=22-08-2024')
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['RptDt']);
    }

    public function test_per_page_is_respected(): void
    {
        $this->actingAsJwt($this->user)
            ->getJson('/api/instruments?per_page=2')
            ->assertOk()
            ->assertJsonPath('meta.per_page', 2)
            ->assertJsonCount(2, 'data');
    }

    public function test_results_are_cached(): void
    {
        Cache::flush();

        // First request populates cache
        $this->actingAsJwt($this->user)->getJson('/api/instruments?TckrSymb=PETR4')->assertOk();

        // Add a new record – it should NOT appear in cached response
        Instrument::create($this->instrumentData(['TckrSymb' => 'PETR4', 'RptDt' => '2024-09-01']));

        $response = $this->actingAsJwt($this->user)
            ->getJson('/api/instruments?TckrSymb=PETR4')
            ->assertOk();

        // Cache still returns the original count (before the new insert)
        $this->assertSame(1, $response->json('meta.total'));
    }

    public function test_requires_authentication(): void
    {
        $this->getJson('/api/instruments')->assertUnauthorized();
    }

    // ── Helpers ───────────────────────────────────────────────────────────────

    protected function actingAsJwt(User $user): InstrumentSearchTest
    {
        $token = auth('api')->login($user);

        return $this->withHeader('Authorization', "Bearer {$token}");
    }

    private function seedInstruments(): void
    {
        $rows = [
            ['TckrSymb' => 'AMZO34', 'RptDt' => '2024-08-22', 'MktNm' => 'EQUITY-CASH', 'SctyCtgyNm' => 'BDR', 'ISIN' => 'BRAMZOBDR002', 'CrpnNm' => 'AMAZON.COM, INC'],
            ['TckrSymb' => 'AMZO34', 'RptDt' => '2024-08-26', 'MktNm' => 'EQUITY-CASH', 'SctyCtgyNm' => 'BDR', 'ISIN' => 'BRAMZOBDR002', 'CrpnNm' => 'AMAZON.COM, INC'],
            ['TckrSymb' => 'PETR4', 'RptDt' => '2024-08-22', 'MktNm' => 'EQUITY-CASH', 'SctyCtgyNm' => 'SHARES', 'ISIN' => 'BRPETRACNPR6', 'CrpnNm' => 'PETROBRAS'],
            ['TckrSymb' => 'VALE3', 'RptDt' => '2024-08-22', 'MktNm' => 'EQUITY-CASH', 'SctyCtgyNm' => 'SHARES', 'ISIN' => 'BRVALECNOR0', 'CrpnNm' => 'VALE S.A.'],
            ['TckrSymb' => 'MGLU3', 'RptDt' => '2024-08-26', 'MktNm' => 'EQUITY-CASH', 'SctyCtgyNm' => 'SHARES', 'ISIN' => 'BRMGLUACNOR0', 'CrpnNm' => 'MAGAZINE LUIZA S.A.'],
        ];

        foreach ($rows as $row) {
            Instrument::create($this->instrumentData($row));
        }
    }

    private function instrumentData(array $overrides = []): array
    {
        return array_merge([
            'TckrSymb' => 'TEST1',
            'RptDt' => '2024-08-22',
            'MktNm' => 'EQUITY-CASH',
            'SctyCtgyNm' => 'SHARES',
            'ISIN' => 'BRTESTCN0000',
            'CrpnNm' => 'TEST CORP',
            'file_upload_id' => '000000000000000000000001',
        ], $overrides);
    }
}
