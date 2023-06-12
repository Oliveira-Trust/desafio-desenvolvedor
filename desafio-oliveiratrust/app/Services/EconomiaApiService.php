<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Exception;

class EconomiaApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.economia_api.url');
    }

    public function getAvailableCurrencies()
    {
        $endpoint = $this->baseUrl . '/json/available/uniq';

        $response = Http::get($endpoint);

        if ($response->successful()) {
            return $response->object();
        }

        throw new Exception('Não foi possível buscar a lista de moedas.');
    }


    public function getTaxConversion($origin, $destination)
    {
        $endpoint = $this->baseUrl . "/json/last/$origin-$destination";

        $response = Http::get($endpoint);

        if ($response->successful()) {
            return $response->object();
        }

        throw new Exception('Aconteceu algum problema ao buscar os dados da conversão :(');
    }

    
}
