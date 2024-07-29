<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Exception;

class ExchangeService
{
    /**
     * Usa o código da moeda para saber quais as moedas disponiveis para conversão.
     *
     * @return array|null
     */
    public function getAvailableExchanges($codeCoin)
    {
        try {
            // Fazer a requisição para a API externa com um timeout de 1 segundo
            $response = Http::timeout(1)->get('https://economia.awesomeapi.com.br/json/available');

            // Obter as chaves do array (siglas das moedas)
            $exchanges = array_keys($response->json());

            // Filtrar as chaves que começam com a moeda especificada
            $filteredExchanges = array_filter($exchanges, function ($key) use ($codeCoin) {
                return strpos($key, $codeCoin . '-') === 0;
            });

            return [
                'status' => 'success',
                'data' => $filteredExchanges
            ];
        } catch (Exception $e) {
            // Logar o erro e retornar mensagem de erro
            Log::error('Erro ao obter as taxas de câmbio: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => 'Não foi possível obter moedas para cotação'
            ];
        }
    }


    /**
     * Get exchange rate for a single exchange.
     *
     * @param string $exchange
     * @return array
     */
    public function getExchangeRates($exchanges)
    {
        $exchangeDetails = [];

        try {
            $responseCoinNames = Http::timeout(1)->get('https://economia.awesomeapi.com.br/json/available/uniq');
            $coinNamesJson = $responseCoinNames->json();
            
            $coinNames = [
                'status' => 'sucess',
                'data' => $coinNamesJson
            ];
        } catch (Exception $e) {
            // Logar o erro e retornar mensagem de erro
            Log::error('Erro ao obter o nome da moeda: ' . $e->getMessage());
            $coinNames = [
                'status' => 'error',
                'data' => null
            ];
        }

        foreach ($exchanges as $exchange) {
            try {
                $exchangesRateRequest = Http::timeout(1)->get('https://economia.awesomeapi.com.br/json/last/' . $exchange);
                $exchangesRate = $exchangesRateRequest->json();
                $exchangeKey = array_key_first($exchangesRate);
                $codein = $exchangesRate[$exchangeKey]['codein'];
                $code = $exchangesRate[$exchangeKey]['code'];

                $exchangeDetails[$exchange] = [
                    'transaction' => $exchange,
                    'code' => $exchangesRate[$exchangeKey]['code'],
                    'coinName' => $coinNames['data'][$code] ?? 'Nome não disponível',
                    'codeIn' => $codein,
                    'coinInName' => $coinNames['data'][$codein] ?? 'Nome não disponível',
                    'bid' => $exchangesRate[$exchangeKey]['bid'],
                    
                ];
            } catch (Exception $e) {
                Log::error('Erro ao obter os detalhes para ' . $exchange . ': ' . $e->getMessage());
                $exchangeDetails[$exchange] = [
                    'code' => null,
                    'codein' => null,
                    'bid' => 'Erro ao obter detalhes',
                    'name' => 'Nome não disponível'
                ];
            }
        }
        
        return [
            'status' => 'success',
            'data' => $exchangeDetails
        ];
    }



    /**
     * Get the name of a coin based on its code.
     *
     * @param string $coinCode
     * @return array|string
     */
    public function getCoinName($coinCode)
    {
        try {
            // Fazer a requisição para a API externa com um timeout de 1 segundo
            $response = Http::timeout(1)->get('https://economia.awesomeapi.com.br/json/available/uniq');

            $coinName = $response->json();
            return [
                'status' => 'success',
                'data' => $coinName[$coinCode] ?? 'Nome da moeda não encontrado'
            ];
        } catch (Exception $e) {
            // Logar o erro e retornar mensagem de erro
            Log::error('Erro ao obter o nome da moeda: ' . $e->getMessage());
            return [
                'status' => 'error',
                'message' => 'Erro ao obter o nome da moeda'
            ];
        }
    }
}
