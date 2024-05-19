<?php

namespace App\Services\Currency;

use App\Interface\Currency\CurrencyServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class CurrencyService implements CurrencyServiceInterface
{
    private $client;
    private $baseUri;
    public function __construct(Client $guzzleHttp)
    {
        $this->client = new $guzzleHttp(self::getHttpHeaders());
        $this->baseUri = env('API_CONVERTER_URL');
    }

    /**
     * Returns an array of HTTP headers for making API requests.
     *
     * @return array An array containing the following keys:
     *               - 'headers': An associative array with the 'Content-Type' header set to 'application/json'.
     *               - 'http_errors': A boolean indicating whether or not to throw exceptions on HTTP errors.
     *               - 'timeout': The timeout value for the API request, retrieved from the 'API_CONVERTER_TIMEOUT' environment variable. Defaults to 10 seconds if not set.
     */
    public static function getHttpHeaders(){
        return [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'http_errors' => false,
            'timeout' => env('API_CONVERTER_TIMEOUT', 10),
        ];
    }

    public function getLatestOccurrences(string $currencies): array
    {
        try {
            $response = $this->client->request('GET', $this->baseUri . '/last/' . $currencies);
            return json_decode($response->getBody(), true, JSON_THROW_ON_ERROR);
        } catch (RequestException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getAvailableCurrencies(): array
    {
        //TODO: implementar essa funcao
        return [];
    }

    public function getCurrencyNames(): array
    {
        //TODO: implementar essa funcao
        return [];
    }
}