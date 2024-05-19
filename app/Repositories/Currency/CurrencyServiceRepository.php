<?php

namespace App\Repositories\Currency;

use App\Interface\Currency\CurrencyServiceInterface;
use App\Services\Currency\CurrencyService;
use App\Services\Cache\CacheService;


class CurrencyServiceRepository implements CurrencyServiceInterface
{
    private $currencyService;
    private $cache;
    private $cacheTime;

    public function __construct(CurrencyService $currencyService, CacheService $cache)
    {
        $this->currencyService = $currencyService;
        $this->cache = $cache;
    }

    public function getLatestOccurrences(array $currencies)
    {
        try {
            $cachedData = [];
            foreach ($currencies as $currency) {
                $key = preg_replace('/[^A-Za-z]/', '', $currency);

                if ($this->cache->isDataCached($key)) {
                    $data = $this->cache->getCachedData($key);
                } else {
                    $data = $this->currencyService->getLatestOccurrences([$currency]);
                    $this->cache->saveDataToCache($key, $data[$key]);
                }
                
                $cachedData[$currency] = $data[$key];
            }
            
            return $cachedData;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function getAvailableCurrencies(): array
    {
        $key = 'currencies';
        return $this->getDataFromCacheOrService($key, 'getAvailableCurrencies');
    }

    public function getCurrencyNames(): array
    {
        $key = 'currencyNames';
        return $this->getDataFromCacheOrService($key, 'getCurrencyNames');
    }

    private function getDataFromCacheOrService($key, $serviceMethod)
    {
        try {
            if ($this->cache->isDataCached($key)) {
                return $this->cache->getCachedData($key);
            } else {
                $data = $this->currencyService->$serviceMethod();
                $this->cache->saveDataToCache($key, $data, 86400);
                return $data;
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

}