<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    protected $cacheTime;

    public function __construct()
    {
        $this->cacheTime = 6000;
    }

    public function remember($key, $callback)
    {
        return Cache::remember($key, $this->cacheTime, $callback);
    }

    public function generateCacheKey($prefix, $params)
    {
        return $prefix . '_' . implode('_', array_map(
            fn($key, $value) => $key . '=' . $value,
            array_keys($params),
            $params
        ));
    }
}
