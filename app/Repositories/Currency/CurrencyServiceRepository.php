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
                    $this->cache->saveDataToCache($key, $data);
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
        //TODO: implementar essa funcao
        return [];
    }

    public function getCurrencyNames(): array
    {
        //TODO: implementar essa funcao
        return [];
    }

}