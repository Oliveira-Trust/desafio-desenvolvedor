<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;

class CurrencyApi
{
    public static function execute(string $destiny, string $origin = 'BRL')
    {
        $collectionHeader = $destiny.$origin;
        $request = Http::get(env('CURRENCY_API_URL') . $destiny . '-'. $origin, []);

        return json_decode($request->body())->$collectionHeader;
    }
}