<?php

namespace App\Http\Services;

use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class CurrencyApiService
{
    protected const API_BASE_URL = "https://economia.awesomeapi.com.br/json/last/";

    public static function currentQuoteForCurrency(string $sourceCurrency, string $targetCurrency): object | null
    {
        $endPoint = self::API_BASE_URL . "{$targetCurrency}-{$sourceCurrency}";

        $response = Http::get($endPoint);

        if ($response->status() !== 200) {
            return null;
        }

        return $response
            ->object()
            ->{"{$targetCurrency}{$sourceCurrency}"};
    }
}
