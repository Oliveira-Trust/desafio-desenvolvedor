<?php

namespace App\Services;

use GuzzleHttp\Client;

class Moedas {
    public $moedas = null;

    public function getMoedas($moedas) {
        $client = new Client();

        try {
            $response = $client->request('GET', 'https://economia.awesomeapi.com.br/json/last/'.$moedas);
    
                
            if ($response->getStatusCode() === 200) {
                $this->moedas = json_decode($response->getBody(), true);
            }
    
            $arr_moedas = collect(json_decode($response->getBody(), true));
            $this->moedas = $arr_moedas->map(function($arr) {
                $temp = explode('/', $arr['name']);
                return ['code' => $arr['code'], 'name' => $temp[0], 'bid' => $arr['bid']];
            });

            return $this->moedas;

        } catch (\Exception $e) {
            return response("Ocorreu um erro ao listar as moedas", 500);
        }
    }
}