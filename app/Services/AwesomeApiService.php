<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Cache;
use Throwable;

class AwesomeApiService
{
    protected Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://economia.awesomeapi.com.br/json/last',
            'timeout'  => 2.0,
        ]);
    }

    public function getExchangeRate(string $currency): array
    {
        return Cache::remember("exchange_rate_$currency", 60, function () use ($currency): array {
            try {
                $response = $this->client->get("/BRL-$currency");
                return json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
            } catch (GuzzleException | Throwable $e) {
                logger()->error('Error fetching exchange rate', ['currency' => $currency, 'exception' => $e]);
                return ['error' => "Não foi possível obter a taxa de câmbio para $currency."];
            }
        });
    }
}
