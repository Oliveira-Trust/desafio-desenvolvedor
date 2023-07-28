<?php
// app/Gateways/CurrencyApiGateway.php

namespace App\Gateways;

use Illuminate\Support\Facades\Http;

class CurrencyApiGateway
{
    private $apiUrl;
    private $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('currency_api.url');
        $this->apiKey = config('currency_api.key');
    }

    public function getExchangeRate(string $baseCurrency, string $targetCurrency): float
    {
        $response = Http::get("{$this->apiUrl}/latest?base={$baseCurrency}&symbols={$targetCurrency}&access_key={$this->apiKey}");

        if ($response->failed()) {
            throw new \Exception('Failed to fetch exchange rate from API.');
        }

        $rates = $response->json()['rates'];

        return $rates[$targetCurrency] ?? 0;
    }
}
