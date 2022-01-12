<?php

namespace App\Domain\Price\Gateways;

use App\Domain\Price\Gateways\Interfaces\PriceGatewayInterface;
use Illuminate\Support\Facades\Http;

class AwesomeApiEconomiaGateway implements PriceGatewayInterface {

    public function getPrice(string $currencyCode):?array
    {
        try {
            $response = Http::get('https://economia.awesomeapi.com.br/json/last/'.$currencyCode);
        } catch (\Exception $e) {

            return null;
        }

        if($response->failed()) {
            return null;
        }

        return $response->json()[$currencyCode.'BRL'];
    }

}
