<?php

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class CurrencyQuoteApi
{
    public static function getAvailableCurrencies(): array|bool
    {
        $response = Http::get("https://economia.awesomeapi.com.br/json/available");
               
        if (!$response->ok()) {
            return false;
        }

        $regex_suffix = '/-BRL$/';
        $brl_combinations = preg_grep($regex_suffix, array_keys($response->json()));
        
        $available_currencies = collect($brl_combinations)->map(function ($combination) use ($regex_suffix) {
            return preg_replace($regex_suffix, '', $combination);
        });

        return $available_currencies->toArray();
    }
      
    public function getCurrencyPrice(string $currencyCode): float|bool
    {
        $response = Http::get("https://economia.awesomeapi.com.br/last/{$currencyCode}-BRL");

        if (!$response->ok()) {
            return false;
        }

        $bid = Arr::get($response->json(), "{$currencyCode}BRL.bid");

        return $bid ?: false;
    }
}
