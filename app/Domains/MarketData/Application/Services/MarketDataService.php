<?php

namespace App\Domains\MarketData\Application\Services;

use App\Domains\MarketData\Infrastructure\Persistence\Eloquent\MarketData;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Redis\Connections\PhpRedisConnection;

final class MarketDataService
{
    private const CACHE_KEY_VERSION = 'v1';
    private const CACHE_INVALIDATION_SCAN_COUNT = 500;

    public function search(?string $ticker = null, ?string $reportDate = null, ?int $perPage = null, ?int $page = null): array
    {
        $ttl = now()->addMinutes(5);

        $page = max($page ?? 1, 1);
        $perPage = min($perPage ?? 10, 100);
        $normalizedTicker = $this->normalizeTicker($ticker);
        $requiresPagination = $this->requiresPagination($normalizedTicker);

        $cacheKey = $this->makeCacheKey($normalizedTicker, $reportDate, $page, $perPage, $requiresPagination);

        $query = MarketData::query()
            ->select([
                'rpt_dt',
                'tckr_symb',
                'mkt_nm',
                'scty_ctgy_nm',
                'isin',
                'crpn_nm',
            ])
            ->when($normalizedTicker !== null, fn($builder) => $builder->where('tckr_symb', $normalizedTicker))
            ->when($reportDate !== null, fn($builder) => $builder
                ->where('rpt_dt', '>=', $reportDate . ' 00:00:00')
                ->where('rpt_dt', '<', $reportDate . ' 23:59:59'))
            ->orderBy('rpt_dt', 'desc')
            ->orderBy('tckr_symb');

        if (! $this->shouldCacheQuery($requiresPagination)) {
            return $this->runSearch($query, $requiresPagination, $perPage, $page);
        }

        return Cache::remember(
            $cacheKey,
            $ttl,
            fn() => $this->runSearch($query, $requiresPagination, $perPage, $page)
        );
    }

    private function makeCacheKey(?string $ticker, ?string $reportDate, int $page, int $perPage, bool $requiresPagination): string
    {
        $normalizedTicker = $ticker ?? 'all';
        $normalizedDate = $reportDate ?? 'all';

        if ($requiresPagination) {
            return sprintf(
                'market-data:%s:ticker=%s:date=%s:page=%d:per_page=%d',
                self::CACHE_KEY_VERSION,
                $normalizedTicker,
                $normalizedDate,
                $page,
                $perPage,
            );
        }

        return sprintf(
            'market-data:%s:ticker=%s:date=%s',
            self::CACHE_KEY_VERSION,
            $normalizedTicker,
            $normalizedDate,
        );
    }

    private function normalizeTicker(?string $ticker): ?string
    {
        if ($ticker === null) {
            return null;
        }

        $normalizedTicker = strtoupper(trim($ticker));

        return $normalizedTicker === '' ? null : $normalizedTicker;
    }

    private function requiresPagination(?string $ticker): bool
    {
        return $ticker === null;
    }

    private function shouldCacheQuery(bool $requiresPagination): bool
    {
        return $requiresPagination;
    }

    private function runSearch($query, bool $requiresPagination, int $perPage, int $page): array
    {
        if ($requiresPagination) {
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
    }

    public function invalidateCache(): void
    {
        $pattern = sprintf('*market-data:%s:*', self::CACHE_KEY_VERSION);
        $redis = Redis::connection('cache');

        foreach ($this->scanCacheKeys($redis, $pattern) as $key) {
            $logicalKey = strstr((string) $key, 'market-data:');

            if ($logicalKey === false) {
                continue;
            }

            Cache::forget($logicalKey);
        }
    }

    /**
     * @return \Generator<int, string>
     */
    private function scanCacheKeys($redis, string $pattern): \Generator
    {
        $defaultCursorValue = $redis instanceof PhpRedisConnection
            && version_compare((string) phpversion('redis'), '6.1.0', '>=')
            ? null
            : '0';

        $cursor = $defaultCursorValue;

        do {
            $scanResult = $redis->scan($cursor, [
                'match' => $pattern,
                'count' => self::CACHE_INVALIDATION_SCAN_COUNT,
            ]);

            if (! is_array($scanResult)) {
                break;
            }

            [$cursor, $keys] = $scanResult;

            if (! is_array($keys) || $keys === []) {
                continue;
            }

            foreach (array_unique($keys) as $key) {
                yield (string) $key;
            }
        } while ((string) $cursor !== (string) $defaultCursorValue);
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
