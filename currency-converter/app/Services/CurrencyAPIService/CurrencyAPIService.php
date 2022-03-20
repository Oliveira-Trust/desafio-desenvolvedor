<?php

namespace App\Services\CurrencyAPIService;

use App\Enums\HttpMethods;
use GuzzleHttp\Client;
use Throwable;

abstract class CurrencyAPIService
{
    private $method = HttpMethods::GET;
    private $endpoint = '';
    private $client;

    const BASE_CONFIG = 'services.currency-api.';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public static function getURL(): string
    {
        return config(self::BASE_CONFIG . 'url');
    }

    public function request($payload)
    {
        $url = $this->getUrl() . $this->getEndpoint();
        $methodName = $this->getMethod()->name;

        $payload = $this->beforeRequest($payload);

        try {

            $response = $this->client->request(
                $methodName,
                $url,
                [
                    'headers' => $this->getHeaders(),
                    'body' => $payload,
                ]
            );
            
            $response = json_decode($response->getBody(), true);

            return $this->afterResponse($response);

        } catch (Throwable $throwable) {
            return $throwable->getMessage();
        }
        
    }

    public function getHeaders()
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    abstract public function beforeRequest($payload);
    abstract public function afterResponse($response);
    abstract public function getMethod(): HttpMethods;
    abstract public function getEndpoint(): string;
    abstract public function isEnable(): bool;
}