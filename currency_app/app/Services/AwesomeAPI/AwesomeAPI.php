<?php

namespace App\Services\AwesomeAPI;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AwesomeAPI
{
    private function getEndpoint($uri = '')
    {
        return Str::finish(config('services.awesome_api.base_url'), '/') . $uri;
    }

    public function request(string $url, $data = [], $cache_key) {
        if (Cache::has($cache_key)) {
            return $this->getFromCache($cache_key);
        }

        $response = Http::asJson()->acceptJson()->get($url, $data)->json();

        $this->storeCache($cache_key, $response);

        return collect($response);
    }

    public function getAvailableCurrencies() {
        $url = $this->getEndpoint('available/uniq');

        $cache_key = $this->getKeyCache('all_currencies');
        $currencies = $this->request($url, [], $cache_key);

        return $currencies;
    }

    public function getCurrencyQuote(string $origin, string $destination) {
        $url = $this->getEndpoint("{$destination}-{$origin}");

        $cache_key = $this->getKeyCache($destination, $origin);
        $currency = $this->request($url, [], $cache_key);

        return $currency;
    }

    private function getKeyCache(...$params) : string
    {
        $cache_key = '_awasome_api_';

        foreach ($params as $param) {
            $cache_key .= $param . '_';
        }

        return $cache_key;
    }


    private function storeCache($key, $data, $ttl = 3600) : void
    {
        Cache::put($key, $data, $ttl);
    }


    private function getFromCache($key)
    {
        $from_cache = Cache::get($key);
        return collect($from_cache);
    }
}
