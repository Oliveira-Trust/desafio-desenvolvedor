<?php

namespace Module\Broker\Gateway;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EconomyAwesomeApiGateway implements CurrencyConvertGateway
{
    const API_URL = 'https://economia.awesomeapi.com.br/json/last/:moedas';

    /**
     * @throws \Exception
     */
    public function convert(string $to, string $from = 'BRL'): int
    {
        $url = str_replace(':moedas', "{$to}-{$from}", self::API_URL);
        $response = Http::get($url);
        if ($response->failed()) {
            throw new \Exception('Error on request in api');
        }
        Log::info($response->json());
        $value = $response->json()[$to.$from]['bid'];
        Log::info('Valor para conversão: '.number_format($value, 2, '.', '') * 100);

        return number_format($value, 2, '.', '') * 100;
    }
}
