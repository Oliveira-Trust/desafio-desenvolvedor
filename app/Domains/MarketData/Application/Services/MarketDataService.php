<?php

namespace App\Domains\MarketData\Application\Services;

use App\Domains\MarketData\Infrastructure\Persistence\Eloquent\MarketData;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

final class MarketDataService
{
    private const CACHE_KEY_VERSION = 'v1';

    public function search(?string $ticker = null, ?string $reportDate = null, ?int $perPage = null, ?int $page = null): array
    {
        $ttl = now()->addMinutes(5);

        $page = max($page ?? 1, 1);
        $perPage = min($perPage ?? 10, 100);

        $cacheKey = $this->makeCacheKey($ticker, $reportDate, $page, $perPage);

        $query = MarketData::query()
            ->select([
                'rpt_dt',
                'tckr_symb',
                'mkt_nm',
                'scty_ctgy_nm',
                'isin',
                'crpn_nm',
            ])
            ->when($ticker !== null, fn($builder) => $builder->where('tckr_symb', $ticker))
            ->when($reportDate !== null, fn($builder) => $builder->whereDate('rpt_dt', $reportDate))
            ->orderBy('rpt_dt', 'desc')
            ->orderBy('tckr_symb');

        return Cache::remember($cacheKey, $ttl, function () use ($query, $ticker, $reportDate, $perPage, $page) {
            if ($ticker === null && $reportDate === null) {
                $paginator = $query->paginate($perPage, ['*'], 'page', $page);

                return [
                    'data' => $this->serializeItems($paginator->items()),
                    'meta' => [
                        'current_page' => $paginator->currentPage(),
                        'last_page' => $paginator->lastPage(),
                        'per_page' => $paginator->perPage(),
                        'total' => $paginator->total(),
                    ],
                ];
            }

            $items = $query->get();

            return [
                'data' => $this->serializeItems($items->all()),
                'meta' => [
                    'total' => $items->count(),
                ],
            ];
        });
    }

    private function makeCacheKey(?string $ticker, ?string $reportDate, int $page, int $perPage): string
    {
        $normalizedTicker = $ticker ? strtoupper(trim($ticker)) : 'all';
        $normalizedDate = $reportDate ?? 'all';
        $hasFilters = $ticker !== null || $reportDate !== null;

        if ($hasFilters) {
            return sprintf(
                'market-data:%s:ticker=%s:date=%s',
                self::CACHE_KEY_VERSION,
                $normalizedTicker,
                $normalizedDate,
            );
        }

        return sprintf(
            'market-data:%s:ticker=%s:date=%s:page=%d:per_page=%d',
            self::CACHE_KEY_VERSION,
            $normalizedTicker,
            $normalizedDate,
            $page,
            $perPage,
        );
    }

    public function invalidateCache(): void
    {
        $prefix = config('cache.prefix');
        $pattern = sprintf('%smarket-data:%s:*', $prefix ? $prefix . '-' : '', self::CACHE_KEY_VERSION);

        foreach (Redis::connection('cache')->scan(match: $pattern) as $key) {
            Redis::connection('cache')->del($key);
        }
    }

    /**
     * @param  array<int, object>  $items
     * @return array<int, array<string, string>>
     */
    private function serializeItems(array $items): array
    {
        return array_map(
            static fn(object $item): array => [
                'rpt_dt' => (string) $item->rpt_dt,
                'tckr_symb' => (string) $item->tckr_symb,
                'mkt_nm' => (string) $item->mkt_nm,
                'scty_ctgy_nm' => (string) $item->scty_ctgy_nm,
                'isin' => (string) $item->isin,
                'crpn_nm' => (string) $item->crpn_nm,
            ],
            $items,
        );
    }
}
