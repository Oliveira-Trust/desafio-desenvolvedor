<?php

namespace App\Actions;

use Illuminate\Support\Facades\Http;

class ExchangeApi
{
    public static function request(string $destiny, string $origin = 'BRL')
    {
// criar verificação de status code 200 para seguir
        $index = $destiny.$origin;
        $request = Http::get(env('EXCHANGE_API') . $destiny . '-'. $origin, []);

        return json_decode($request->body())->$index;
        }
}
