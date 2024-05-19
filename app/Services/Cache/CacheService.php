<?php
namespace App\Services\Cache;

use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
class CacheService
{
    private $defaultTime;
    private $cacheTimeUp;
    public function __construct()
    {
        $this->defaultTime = env('API_CONVERTER_CACHE_DEFAULT');
        $this->cacheTimeUp = env('API_CONVERTER_TIME_UPDATE');
    }

    /**
     * Check if data is cached.
     *
     * @param string $cacheKey The cache key.
     * @return bool Returns true if data is cached, false otherwise.
     */
    public function isDataCached(string $cacheKey): bool
    {
        return Cache::has($cacheKey);
    }

    /**
     * Check if cached data is still valid.
     *
     * @param string $cacheKey The cache key.
     * @return bool Returns true if cached data is still valid, false otherwise.
     */
    public function isDataValid(string $cacheKey): bool
    {
        if ($this->isDataCached($cacheKey)) {
            $cachedData = $this->getCachedData($cacheKey);
            $createDate = Carbon::createFromTimestamp($cachedData['data']['create_date']);
            $diffInSecondsAPI = Carbon::now()->diffInSeconds($createDate);
            $diffInSecondsCache = Carbon::now()->diffInSeconds($cachedData['create_cache']);

            if (($diffInSecondsCache <= $this->defaultTime || $diffInSecondsAPI <= $this->cacheTimeUp)) {
                return true;
            }
        }
        return false;
    }

    public function getCachedData(string $cacheKey): array
    {
        return cache()->get($cacheKey);
    }

    public function saveDataToCache(string $cacheKey, $data , $time = null): void
    {
        $cacheTime = $time ?? $this->cacheTimeUp;
        
        cache()->put($cacheKey, [
            'data' => $data,
            'create_cache' => time()
        ], $cacheTime);
    }
}
