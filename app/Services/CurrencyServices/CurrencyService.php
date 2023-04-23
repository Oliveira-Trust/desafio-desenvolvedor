<?php

namespace App\Services\CurrencyServices;

use Exception;
use Illuminate\Support\Facades\Http;

class CurrencyService
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl= "https://economia.awesomeapi.com.br/json/";
    }

    public function lastExchange(string $currencies, $methodUrl = "last/")
    {
        try {
            $response = Http::get($this->baseUrl . $methodUrl . "/" . $currencies);
            return json_decode($response->getBody());
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            return [ false, $msg ];
        }
    }

    public function listCurrencies($methodUrl = "available/uniq/")
    {
        try {
            $response = Http::get($this->baseUrl . $methodUrl);
            return json_decode($response->getBody());
        } catch (Exception $ex) {
            $msg = $ex->getMessage();
            return [ false, $msg ];
        }
    }
}
