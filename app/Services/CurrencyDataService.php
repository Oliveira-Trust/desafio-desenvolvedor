<?php

namespace App\Services;
use App\Contracts\ExternalDataInterface;

class CurrencyDataService implements ExternalDataInterface
{
    protected $client;

    public function __construct(\GuzzleHttp\Client $client)
    {
        $this->client = $client;
    }

    public function getData(string $endpoint)
    {
        $response = $this->client->get($endpoint);
        return $response;
    }

    public function postData(string $endpoint, Array $params)
    {
        $response = $this->client->post($endpoint);
        return $response;
    }
}