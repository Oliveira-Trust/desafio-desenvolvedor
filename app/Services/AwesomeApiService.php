<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

/**
 * @method static shouldReceive(string $string)
 */
class AwesomeApiService
{
    const URL_BASE = 'https://economia.awesomeapi.com.br/json';

    public static function getCurrencies($currency = null)
    {
        $response = Http::get(static::URL_BASE . '/available/uniq');
        if($response->status() == 200){
            return $currency ? $response->json()[$currency] : $response->json();
        }
        return null;
    }

    public static function exchange($source, $target)
    {
        $response = Http::get(static::URL_BASE . "/last/{$source}-{$target}");
        if($response->status() == 200){
            return $response->json();
        }
        return null;
    }

    public static function getAvailable()
    {
        $response = Http::get(static::URL_BASE . "/available");
        if ($response->status() == 200) {
            return $response->json();
        }
        return null;
    }
}
