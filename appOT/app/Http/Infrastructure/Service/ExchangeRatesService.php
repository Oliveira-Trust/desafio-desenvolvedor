<?php

namespace App\Http\Infrastructure\Service;
use Illuminate\Support\Facades\Http;
class ExchangeRatesService
{
  public function getExchangeRates(string $destinationCurrency='USD'){
    try {
      return  Http::get(env('EXCHANGE_RATE').'BRL-' . $destinationCurrency);
          
    } catch (\Throwable $th) {
      return response()->json(['error'=>'Failed to retrieve exchange rate'], 503);
    }
  }
}