<?php

namespace Oliveiratrust\CurrencyPrice\API;

use Http;
use Oliveiratrust\Models\Currency\Currency;

class CurrencyPricewesomeAPI {

    private string $url;

    public function __construct()
    {
        $this->url = 'https://economia.awesomeapi.com.br/json/last';
    }

    public function call(Currency $currency)
    {
        $response = Http::retry(3, 1000)->get("$this->url/$currency->code-BRL");

        if ($response->ok()) {
            $data = $response->json("{$currency->code}BRL");

            return round((float)$data['bid'], 4);
        }
    }
}
