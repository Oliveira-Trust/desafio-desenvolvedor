<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AwesomeApiService {



     /**
      * Método reposnsável por recuperar o valor conversão da moeda padrão (REAL - BRL) 
      * para a moeda destino recebido no parâmetro $coin
      * 
      *
      * @return string $response
      *
      */

      public function getQuotation($coin)
      {

        $coin = strtoupper($coin);
        $request = Http::get('https://economia.awesomeapi.com.br/json/last/'.$coin.'-BRL');

        if ($coin == "USD"){
          $response = json_decode($request)->USDBRL->bid;
        }

        if ($coin ==  "EUR"){
          $response = json_decode($request)->EURBRL->bid;
        }

        if ($coin ==  "GBP"){
          $response = json_decode($request)->GBPBRL->bid;
        }

        return $response;

      }


}