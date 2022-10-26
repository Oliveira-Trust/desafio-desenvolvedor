<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ConsumeApiService
{
    const NOT_FOUND_HTTP_STATUS_CODE = 404;
    /**
     * Verificação desabilitada para funcionamento dos testes e para evitar perda de tempo em correções de ambiente
     * Assim, evitando afetar a duração ou a qualidade do desafio
     */
    public function fetchCurrencyList(): array
    {
        return Http::withOptions([
            'verify' => false
        ])->get('https://economia.awesomeapi.com.br/json/available/uniq')->json();
    }

    public function getExchange(String $currencyFrom, String $currencyTo): array
    {
        $url = sprintf('https://economia.awesomeapi.com.br/json/last/%s-%s', $currencyFrom, $currencyTo);
        return Http::withOptions([
            'verify' => false
        ])->get($url)->json();
    }
}