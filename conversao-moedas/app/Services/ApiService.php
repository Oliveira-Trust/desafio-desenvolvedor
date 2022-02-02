<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;

class ApiService
{
    private static $urlBase = 'https://economia.awesomeapi.com.br/';

    public static function getAll()
    {
        $endPoint = 'json/all';
        try {
            $response = Http::get(self::$urlBase . "{$endPoint}")->json();
            return $response;
        } catch (\Exception $error) {
            throw new Exception("Ocorreu um erro ao retornar os dados {$error->getMessage()}");
        }
    }

    public static function converterMoeda(string $moedaDestino)
    {
        $endPoint = "last/{$moedaDestino}-BRL";
        try {
            $response = Http::get(self::$urlBase . "{$endPoint}")->json();
            return $response;
        } catch (\Exception $error) {
            throw new Exception("Ocorreu um erro ao converter a moeda {$error->getMessage()}");
        }
    }
}
