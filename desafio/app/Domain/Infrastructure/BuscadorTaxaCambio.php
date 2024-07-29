<?php

namespace App\Domain\Infrastructure;

use Exception;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class BuscadorTaxaCambio
{
    public function obterTaxaCambio(string $currency): float
    {
        try {
            $response = Http::get("https://economia.awesomeapi.com.br/last/BRL-{$currency}");

            if ($response->status() == Response::HTTP_NOT_FOUND) {
                throw new Exception('A moeda especificada não é suportada para conversão.');
            }

            if ($response->failed()) {
                throw new RequestException($response);
            }

            $exchangeData = $response->json();
            if (! isset($exchangeData["BRL{$currency}"])) {
                throw new Exception('Os dados da taxa de câmbio não estão disponíveis no momento.');
            }

            return (float) $exchangeData["BRL{$currency}"]['ask'];
        } catch (RequestException $e) {
            throw new Exception('Falha ao buscar a taxa de câmbio: '.$e->getMessage());
        } catch (Exception $e) {
            throw new Exception('Erro inesperado ao buscar a taxa de câmbio: '.$e->getMessage());
        }
    }
}
