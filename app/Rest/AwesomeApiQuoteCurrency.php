<?php

namespace App\Rest;

use GuzzleHttp\Client;

class AwesomeApiQuoteCurrency
{
    private $client;
    private $url = 'https://economia.awesomeapi.com.br/json';

    public function __construct()
    {
        $this->client = new Client();
    }

    public function lastCurrencyPrice($originCurrencySymbol, $destinationCurrencySymbol)
    {
        $response = $this->client->get($this->url . '/last/' . $originCurrencySymbol . '-' . $destinationCurrencySymbol);
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        return json_decode($response->getBody()->getContents());
    }

}
