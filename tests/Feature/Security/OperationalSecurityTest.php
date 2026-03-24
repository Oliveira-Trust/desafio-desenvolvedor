<?php

namespace Tests\Feature\Security;

use App\Domains\MarketData\Infrastructure\Persistence\Eloquent\MarketData;
use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use App\Domains\User\Infrastructure\Persistence\Eloquent\User;
use Laravel\Sanctum\Sanctum;
use Tests\Concerns\UsesMySqlDatabase;
use Tests\TestCase;

class OperationalSecurityTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_protected_routes_require_sanctum_authentication(): void
    {
        $this->getJson('/api/uploads')->assertStatus(401);
        $this->getJson('/api/market-data?TckrSymb=PETR4')->assertStatus(401);
        $this->postJson('/api/auth/logout')->assertOk();
    }

    public function test_login_uses_sanctum_stateful_session_for_protected_routes(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $this->postJson('/api/auth/login', [
            'email' => 'test@example.com',
            'password' => 'password',
        ])->assertOk()
            ->assertJsonPath('message', 'Login realizado com sucesso.')
            ->assertJsonPath('data.user.email', 'test@example.com');

        $this->getJson('/api/uploads')->assertOk();
        $this->postJson('/api/auth/logout')
            ->assertOk()
            ->assertJsonPath('message', 'Logout realizado com sucesso.');
    }

    public function test_market_data_endpoint_is_rate_limited(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $upload = Upload::query()->create([
            'filename' => 'market.csv',
            'path' => 'uploads/market.csv',
            'mime_type' => 'text/csv',
            'size' => 10,
            'file_md5' => md5('market.csv'),
            'status' => Upload::STATUS_COMPLETED,
            'rows_total' => 1,
            'processed_rows' => 1,
            'failed_rows' => 0,
        ]);

        MarketData::query()->create([
            'upload_id' => $upload->id,
            'rpt_dt' => '2026-03-23',
            'tckr_symb' => 'PETR4',
            'mkt_nm' => 'BOVESPA',
            'scty_ctgy_nm' => 'ACOES',
            'isin' => 'BRPETRACNPR6',
            'crpn_nm' => 'PETROLEO BRASILEIRO SA',
        ]);

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->getJson('/api/market-data?TckrSymb=PETR4')->assertOk();
        }

        $this->getJson('/api/market-data?TckrSymb=PETR4')->assertStatus(429);
    }

    public function test_upload_index_rejects_invalid_search_filters(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->getJson('/api/uploads?per_page=999&date=23-03-2026');

        $response->assertStatus(422);
        $response->assertJsonPath('error.code', 'VALIDATION_ERROR');
        $response->assertJsonStructure([
            'error' => [
                'details' => ['per_page', 'date'],
            ],
        ]);
    }

    public function test_upload_index_filters_by_reference_date_instead_of_created_at(): void
    {
        Sanctum::actingAs(User::factory()->create());

        Upload::query()->create([
            'filename' => 'created-at-match.csv',
            'path' => 'uploads/created-at-match.csv',
            'mime_type' => 'text/csv',
            'size' => 10,
            'file_md5' => md5('created-at-match.csv'),
            'status' => Upload::STATUS_COMPLETED,
            'reference_date' => '2026-03-22',
            'rows_total' => 1,
            'processed_rows' => 1,
            'failed_rows' => 0,
            'created_at' => '2026-03-23 10:00:00',
            'updated_at' => '2026-03-23 10:00:00',
        ]);

        Upload::query()->create([
            'filename' => 'reference-date-match.csv',
            'path' => 'uploads/reference-date-match.csv',
            'mime_type' => 'text/csv',
            'size' => 10,
            'file_md5' => md5('reference-date-match.csv'),
            'status' => Upload::STATUS_COMPLETED,
            'reference_date' => '2026-03-23',
            'rows_total' => 1,
            'processed_rows' => 1,
            'failed_rows' => 0,
            'created_at' => '2026-03-20 10:00:00',
            'updated_at' => '2026-03-20 10:00:00',
        ]);

        $response = $this->getJson('/api/uploads?date=2026-03-23');

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
        $response->assertJsonPath('data.0.filename', 'reference-date-match.csv');
        $response->assertJsonPath('data.0.reference_date', '2026-03-23');
    }

    public function test_market_data_search_sanitizes_ticker_and_accepts_trimmed_input(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $upload = Upload::query()->create([
            'filename' => 'market.csv',
            'path' => 'uploads/market.csv',
            'mime_type' => 'text/csv',
            'size' => 10,
            'file_md5' => md5('market-2.csv'),
            'status' => Upload::STATUS_COMPLETED,
            'rows_total' => 1,
            'processed_rows' => 1,
            'failed_rows' => 0,
        ]);

        MarketData::query()->create([
            'upload_id' => $upload->id,
            'rpt_dt' => '2026-03-23',
            'tckr_symb' => 'PETR4',
            'mkt_nm' => 'BOVESPA',
            'scty_ctgy_nm' => 'ACOES',
            'isin' => 'BRPETRACNPR6',
            'crpn_nm' => 'PETROLEO BRASILEIRO SA',
        ]);

        $response = $this->getJson('/api/market-data?TckrSymb=%20petr4%0A');

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
        $response->assertJsonPath('data.0.TckrSymb', 'PETR4');
    }

    public function test_market_data_endpoint_uses_default_pagination_when_no_filters_are_informed(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $upload = Upload::query()->create([
            'filename' => 'market-default-pagination.csv',
            'path' => 'uploads/market-default-pagination.csv',
            'mime_type' => 'text/csv',
            'size' => 10,
            'file_md5' => md5('market-default-pagination.csv'),
            'status' => Upload::STATUS_COMPLETED,
            'rows_total' => 2,
            'processed_rows' => 2,
            'failed_rows' => 0,
        ]);

        MarketData::query()->create([
            'upload_id' => $upload->id,
            'rpt_dt' => '2026-03-23',
            'tckr_symb' => 'PETR4',
            'mkt_nm' => 'BOVESPA',
            'scty_ctgy_nm' => 'ACOES',
            'isin' => 'BRPETRACNPR6',
            'crpn_nm' => 'PETROLEO BRASILEIRO SA',
        ]);

        MarketData::query()->create([
            'upload_id' => $upload->id,
            'rpt_dt' => '2026-03-22',
            'tckr_symb' => 'VALE3',
            'mkt_nm' => 'BOVESPA',
            'scty_ctgy_nm' => 'ACOES',
            'isin' => 'BRVALEACNOR0',
            'crpn_nm' => 'VALE SA',
        ]);

        $response = $this->getJson('/api/market-data');

        $response->assertOk();
        $response->assertJsonCount(2, 'data');
        $response->assertJsonPath('meta.current_page', 1);
        $response->assertJsonPath('meta.per_page', 10);
        $response->assertJsonPath('meta.total', 2);
        $response->assertJsonPath('meta.last_page', 1);
    }

    public function test_market_data_filters_still_return_paginated_payload(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $upload = Upload::query()->create([
            'filename' => 'market-filtered-pagination.csv',
            'path' => 'uploads/market-filtered-pagination.csv',
            'mime_type' => 'text/csv',
            'size' => 10,
            'file_md5' => md5('market-filtered-pagination.csv'),
            'status' => Upload::STATUS_COMPLETED,
            'rows_total' => 3,
            'processed_rows' => 3,
            'failed_rows' => 0,
        ]);

        MarketData::query()->create([
            'upload_id' => $upload->id,
            'rpt_dt' => '2026-03-23',
            'tckr_symb' => 'PETR4',
            'mkt_nm' => 'BOVESPA',
            'scty_ctgy_nm' => 'ACOES',
            'isin' => 'BRPETRACNPR6',
            'crpn_nm' => 'PETROLEO BRASILEIRO SA',
        ]);

        MarketData::query()->create([
            'upload_id' => $upload->id,
            'rpt_dt' => '2026-03-23',
            'tckr_symb' => 'PETR4',
            'mkt_nm' => 'BOVESPA',
            'scty_ctgy_nm' => 'ACOES',
            'isin' => 'BRPETRACNPR6',
            'crpn_nm' => 'PETROLEO BRASILEIRO SA PN',
        ]);

        MarketData::query()->create([
            'upload_id' => $upload->id,
            'rpt_dt' => '2026-03-22',
            'tckr_symb' => 'VALE3',
            'mkt_nm' => 'BOVESPA',
            'scty_ctgy_nm' => 'ACOES',
            'isin' => 'BRVALEACNOR0',
            'crpn_nm' => 'VALE SA',
        ]);

        $response = $this->getJson('/api/market-data?TckrSymb=PETR4&RptDt=2026-03-23&per_page=1&page=2');

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
        $response->assertJsonPath('meta.current_page', 2);
        $response->assertJsonPath('meta.per_page', 1);
        $response->assertJsonPath('meta.total', 2);
        $response->assertJsonPath('meta.last_page', 2);
        $response->assertJsonPath('data.0.TckrSymb', 'PETR4');
        $response->assertJsonPath('data.0.RptDt', '2026-03-23');
    }

    public function test_market_data_rejects_invalid_per_page_for_filtered_and_unfiltered_queries(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $unfilteredResponse = $this->getJson('/api/market-data?per_page=999');
        $filteredResponse = $this->getJson('/api/market-data?TckrSymb=PETR4&RptDt=2026-03-23&per_page=999');

        $unfilteredResponse->assertStatus(422);
        $unfilteredResponse->assertJsonPath('error.code', 'VALIDATION_ERROR');
        $unfilteredResponse->assertJsonStructure([
            'error' => [
                'details' => ['per_page'],
            ],
        ]);

        $filteredResponse->assertStatus(422);
        $filteredResponse->assertJsonPath('error.code', 'VALIDATION_ERROR');
        $filteredResponse->assertJsonStructure([
            'error' => [
                'details' => ['per_page'],
            ],
        ]);
    }

    public function test_login_endpoint_is_rate_limited(): void
    {
        User::factory()->create([
            'email' => 'security@example.com',
            'password' => 'password',
        ]);

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $this->postJson('/api/auth/login', [
                'email' => 'security@example.com',
                'password' => 'wrong-password',
            ])->assertStatus(401);
        }

        $this->postJson('/api/auth/login', [
            'email' => 'security@example.com',
            'password' => 'wrong-password',
        ])->assertStatus(429);
    }
}
