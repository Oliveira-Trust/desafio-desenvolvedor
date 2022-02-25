<?php

namespace App\Support;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class CurrencyQuoteApi
{      
    /**
     * Returns the current currency value
     * @param string $currencyCode
     * @return float|bool
     */
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
