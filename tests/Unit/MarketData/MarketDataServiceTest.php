<?php

namespace Tests\Unit\MarketData;

use App\Domains\MarketData\Application\Services\MarketDataService;
use App\Domains\MarketData\Infrastructure\Persistence\Eloquent\MarketData;
use App\Domains\Upload\Infrastructure\Persistence\Eloquent\Upload;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Tests\Concerns\UsesMySqlDatabase;
use Tests\TestCase;

class MarketDataServiceTest extends TestCase
{
    use UsesMySqlDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->useMySqlDatabase();
    }

    public function test_search_returns_paginated_results_and_caches_unfiltered_queries(): void
    {
        $upload = $this->createUpload();

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

        $service = new MarketDataService();

        $firstResult = $service->search(page: 1, perPage: 1);

        $this->assertSame(1, $firstResult['meta']['current_page']);
        $this->assertSame(1, $firstResult['meta']['per_page']);
        $this->assertSame(2, $firstResult['meta']['total']);
        $this->assertSame(2, $firstResult['meta']['last_page']);
        $this->assertCount(1, $firstResult['data']);
        $this->assertSame('PETR4', $firstResult['data'][0]['tckr_symb']);

        MarketData::query()->delete();

        $cachedResult = $service->search(page: 1, perPage: 1);

        $this->assertSame($firstResult, $cachedResult);
    }

    public function test_search_normalizes_ticker_and_skips_cache_for_filtered_queries(): void
    {
        $upload = $this->createUpload();

        MarketData::query()->create([
            'upload_id' => $upload->id,
            'rpt_dt' => '2026-03-23',
            'tckr_symb' => 'PETR4',
            'mkt_nm' => 'BOVESPA',
            'scty_ctgy_nm' => 'ACOES',
            'isin' => 'BRPETRACNPR6',
            'crpn_nm' => 'PETROLEO BRASILEIRO SA',
        ]);

        $service = new MarketDataService();

        $firstResult = $service->search(' petr4 ', null, 10, 1);

        $this->assertSame(1, $firstResult['meta']['current_page']);
        $this->assertSame(1, $firstResult['meta']['last_page']);
        $this->assertSame(10, $firstResult['meta']['per_page']);
        $this->assertSame(1, $firstResult['meta']['total']);
        $this->assertCount(1, $firstResult['data']);
        $this->assertSame('PETR4', $firstResult['data'][0]['tckr_symb']);

        MarketData::query()->delete();

        $freshResult = $service->search('petr4', null, 10, 1);

        $this->assertSame(1, $freshResult['meta']['current_page']);
        $this->assertSame(1, $freshResult['meta']['last_page']);
        $this->assertSame(10, $freshResult['meta']['per_page']);
        $this->assertSame(0, $freshResult['meta']['total']);
        $this->assertSame([], $freshResult['data']);
    }

    public function test_search_keeps_pagination_when_filters_are_applied(): void
    {
        $upload = $this->createUpload();
        $ticker = 'PAGI4';
        $reportDate = '2026-04-01';

        MarketData::query()->create([
            'upload_id' => $upload->id,
            'rpt_dt' => $reportDate,
            'tckr_symb' => $ticker,
            'mkt_nm' => 'BOVESPA',
            'scty_ctgy_nm' => 'ACOES',
            'isin' => 'BRPAGIACNPR6',
            'crpn_nm' => 'PAGINATION TEST SA',
        ]);

        MarketData::query()->create([
            'upload_id' => $upload->id,
            'rpt_dt' => $reportDate,
            'tckr_symb' => $ticker,
            'mkt_nm' => 'BOVESPA',
            'scty_ctgy_nm' => 'ACOES',
            'isin' => 'BRPAGIACNPR6',
            'crpn_nm' => 'PAGINATION TEST SA PN',
        ]);

        $service = new MarketDataService();

        $result = $service->search($ticker, $reportDate, 1, 2);

        $this->assertSame(2, $result['meta']['current_page']);
        $this->assertSame(2, $result['meta']['last_page']);
        $this->assertSame(1, $result['meta']['per_page']);
        $this->assertSame(2, $result['meta']['total']);
        $this->assertCount(1, $result['data']);
        $this->assertSame($ticker, $result['data'][0]['tckr_symb']);
    }

    public function test_search_normalizes_per_page_bounds_in_all_query_scenarios(): void
    {
        $upload = $this->createUpload();

        foreach (range(1, 3) as $index) {
            MarketData::query()->create([
                'upload_id' => $upload->id,
                'rpt_dt' => '2026-03-23',
                'tckr_symb' => 'PETR4',
                'mkt_nm' => 'BOVESPA',
                'scty_ctgy_nm' => 'ACOES',
                'isin' => 'BRPETRACNPR6',
                'crpn_nm' => 'PETROLEO BRASILEIRO SA ' . $index,
            ]);
        }

        $service = new MarketDataService();

        $unfilteredResult = $service->search(perPage: 0, page: 1);
        $filteredResult = $service->search('PETR4', '2026-03-23', 0, 1);
        $cappedResult = $service->search('PETR4', '2026-03-23', 999, 1);

        $this->assertSame(1, $unfilteredResult['meta']['per_page']);
        $this->assertCount(1, $unfilteredResult['data']);

        $this->assertSame(1, $filteredResult['meta']['per_page']);
        $this->assertCount(1, $filteredResult['data']);

        $this->assertSame(100, $cappedResult['meta']['per_page']);
        $this->assertSame(3, $cappedResult['meta']['total']);
        $this->assertCount(3, $cappedResult['data']);
    }

    public function test_invalidate_cache_forgets_only_versioned_market_data_keys(): void
    {
        $redis = new class
        {
            public function scan($cursor, array $options): array
            {
                return ['0', [
                    'laravel_cache_market-data:v1:ticker=all:date=all:page=1:per_page=10',
                    'laravel_cache_other-key',
                ]];
            }
        };

        Redis::shouldReceive('connection')
            ->once()
            ->with('cache')
            ->andReturn($redis);

        Cache::shouldReceive('forget')
            ->once()
            ->with('market-data:v1:ticker=all:date=all:page=1:per_page=10');

        $service = new MarketDataService();

        $service->invalidateCache();
    }

    private function createUpload(): Upload
    {
        return Upload::query()->create([
            'filename' => 'market-data.csv',
            'path' => 'uploads/market-data.csv',
            'mime_type' => 'text/csv',
            'size' => 10,
            'file_md5' => md5((string) fake()->uuid()),
            'status' => Upload::STATUS_COMPLETED,
            'rows_total' => 1,
            'processed_rows' => 1,
            'failed_rows' => 0,
        ]);
    }
}
