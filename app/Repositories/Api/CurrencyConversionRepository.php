<?php

namespace App\Repositories\Api;

use App\Repositories\CurrencyConversionContractRepository;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CurrencyConversionRepository implements CurrencyConversionContractRepository
{
    protected PendingRequest $client;

    public function __construct()
    {
        $this->client = Http::retry(5, 100);
    }

    public function convert(array $pairs = []): array
    {
        $search = implode(',', $pairs);
        $cacheKey = md5($search);

        return Cache::remember($cacheKey, 30, function () use ($search, $cacheKey) {
            $endpoint = sprintf('%s/%s', config('services.currency-conversion.endpoint'), $search);
            $response = $this->client->get($endpoint);

            $response->throw();

            $data = $response->json();
            foreach ($data as $key => $value) {
                $expiration = Arr::get($value, 'timestamp') + 30;

                if ($key === 'timestamp') {
                    Cache::put(md5($cacheKey), $value, $expiration - now()->timestamp);
                    break;
                }
            }

            return $data;
        });
    }
}
