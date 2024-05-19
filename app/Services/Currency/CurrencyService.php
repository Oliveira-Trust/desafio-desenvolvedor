<?php

namespace App\Services\Currency;

use App\Interface\Currency\CurrencyServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use App\Helpers\ApiResponse;

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

    /**
     * Get the latest occurrences for the specified currencies.
     *
     * @param  array $currencies The currencies to retrieve occurrences for.
     * @return array An array containing the latest occurrences.
     * @throws \Exception If the API request fails.
     */
    public function getLatestOccurrences(array $currencies): array
    {
        try {
            $currenciesString = implode(',', $currencies);
            $response = $this->client->request('GET', $this->baseUri . '/json/last/' . $currenciesString);
            if ($response->getStatusCode() !== 200) {
                throw new \Exception('API request failed.', $response->getStatusCode());
            }
            return json_decode($response->getBody(), true, JSON_THROW_ON_ERROR);
        } catch (RequestException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    

    public function getAvailableCurrencies(): array
    {
        try {
            $response = $this->client->request('GET', $this->baseUri . '/json/available');
            if ($response->getStatusCode() !== 200) {
                throw new \Exception('API request failed.', $response->getStatusCode());
            }
            return json_decode($response->getBody(), true, JSON_THROW_ON_ERROR);
        } catch (RequestException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }

    public function getCurrencyNames(): array
    {
        try {
            $response = $this->client->request('GET', $this->baseUri . '/json/available/uniq');
            if ($response->getStatusCode() !== 200) {
                throw new \Exception('API request failed.', $response->getStatusCode());
            }
            return json_decode($response->getBody(), true, JSON_THROW_ON_ERROR);
        } catch (RequestException $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}