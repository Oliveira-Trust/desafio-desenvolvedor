<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExchangeRatesService
{
     public function getExchangeRates(string $destinationCurrency)
     {
         $response = Http::asJson()->get('https://economia.awesomeapi.com.br/last/BRL-' . $destinationCurrency);

         if ($response->failed()) {
             throw new \Exception('Could not get exchange rates');
         }

         if ($response->serverError()) {
             throw new \Exception('Could not get exchange rates');
         }

         if ($response->successful()) {
             return $response->json()['BRL'.$destinationCurrency];
         }
     }
}
