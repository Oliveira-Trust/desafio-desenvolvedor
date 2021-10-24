<?php


namespace App\Services\Moeda;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp;

class MoedaService
{
    private $API_URL = 'https://economia.awesomeapi.com.br';

    public function __construct()
    {
    }

    public function getMoeda($codMoedaOrigem, $codMoedaDestino): Collection {
        $combinacaoMoeda = implode("-", [$codMoedaOrigem, $codMoedaDestino]);
        $guzzle = new GuzzleHttp\Client;
        $apiResponse = $guzzle->get("{$this->API_URL}/json/last/{$combinacaoMoeda}");

        if($apiResponse->getStatusCode() != 200){
            throw new \Exception('Erro na Solicitação');
        }

        $results = json_decode($apiResponse->getBody()->getContents(), true);

        if(!isset($results["{$codMoedaOrigem}{$codMoedaDestino}"])){
            throw new \Exception('Erro Huehue');
        }

        return collect(
            $results["{$codMoedaOrigem}{$codMoedaDestino}"]
        );
    }

    public function getCombinacoesMoedas(): Collection{
        $guzzle = new GuzzleHttp\Client;
        $apiResponse = $guzzle->get("{$this->API_URL}/json/available");
        
        if($apiResponse->getStatusCode() != 200){
            throw new \Exception('Erro na Solicitação');
        }

        return collect(
            json_decode($apiResponse->getBody()->getContents(), true)
        );    
    }


    public function getMoedas(): Collection{
        $guzzle = new GuzzleHttp\Client;
        $apiResponse = $guzzle->get("{$this->API_URL}/available/uniq");

        if($apiResponse->getStatusCode() != 200){
            throw new \Exception('Erro na Solicitação');
        }

        return collect(
            json_decode($apiResponse->getBody()->getContents(), true)
        );
    }
}
