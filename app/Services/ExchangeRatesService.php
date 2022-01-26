<?php

namespace App\Services;

use App\Exceptions\ExchangeRateException;
use Illuminate\Support\Facades\Http;

class ExchangeRatesService
{
    /**
     * @throws ExchangeRateException
     */
    public function getExchangeRates(string $destinationCurrency)
     {
         $response = Http::asJson()->get('https://economia.awesomeapi.com.br/last/BRL-' . $destinationCurrency);
         $data = $response->json();

         if ($response->failed()) {
             throw new ExchangeRateException( $data['message'], $data['status']);
         }

         if ($response->clientError()) {
             throw new ExchangeRateException( $data['message'], $data['status']);
         }

         if ($response->serverError()) {
             throw new  ExchangeRateException( $data['message'], $data['status']);
         }

         if ($response->successful()) {
             return $data['BRL'.$destinationCurrency];
         }
     }
}
