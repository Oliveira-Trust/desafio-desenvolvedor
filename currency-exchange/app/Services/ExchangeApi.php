<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExchangeApi
{
    public static function request(string $destiny, string $origin = 'BRL')
    {
        $response = Http::get(env('EXCHANGE_API') . "/" . $destiny . '-'. $origin, []);

        if($response->status() != 200) {
            throw new \Exception($response->body());
        }

        return json_decode($response->body())[0];
    }

    public function getExchanges()
    {
        $exchangeString = implode(",", $this->getExchangeCodeList());

        $apiUrl = env('EXCHANGE_API').'/json/last/'.$exchangeString;
        $response = Http::get($apiUrl);

        if($response->status() != 200) {
            throw new \Exception($response->body());
        }

        return $response->json();
    }


    private function getExchangeCodeList() {
        return [
            "BRL-USD",
            "BRL-EUR",
            "BRL-ARS",
            "BRL-AUD",
            "BRL-CAD",
            "BRL-CHF",
            "BRL-CLP",
            "BRL-DKK",
            "BRL-HKD",
            "BRL-JPY",
            "BRL-MXN",
            "BRL-SGD",
            "BRL-AED",
            "BRL-BBD",
            "BRL-BHD",
            "BRL-CNY",
            "BRL-CZK",
            "BRL-EGP",
            "BRL-GBP",
            "BRL-HUF",
            "BRL-IDR",
            "BRL-ILS",
            "BRL-INR",
            "BRL-ISK",
            "BRL-JMD",
            "BRL-JOD",
            "BRL-KES",
            "BRL-KRW",
            "BRL-LBP",
            "BRL-LKR",
            "BRL-MAD",
            "BRL-MYR",
            "BRL-NAD",
            "BRL-NOK",
            "BRL-NPR",
            "BRL-NZD",
            "BRL-OMR",
            "BRL-PAB",
            "BRL-PHP",
            "BRL-PKR",
            "BRL-PLN",
            "BRL-QAR",
            "BRL-RON",
            "BRL-RUB"
        ];
    }

}
