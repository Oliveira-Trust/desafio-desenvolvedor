<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;

class ContacaoMoedaClientService
{
    public function getPrecoMoeda($codigoMoeda)
    {
        $response = Http::get("https://economia.awesomeapi.com.br/last/{$codigoMoeda}-BRL");

        if (!$response->ok()) {
            return false;
        }

        $bid = Arr::get($response->json(), "{$codigoMoeda}BRL.bid");

        return $bid ?: false;
    }
}
