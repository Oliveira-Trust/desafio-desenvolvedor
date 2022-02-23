<?php

namespace App\Services;

use GuzzleHttp\Client;

class CurrencyQuoteClientService
{
    public function __construct(private Client $client)
    {
    }

    public function getLastQuote(string $origin, string $target): float
    {
        $currentQuoteRequest = $this->client->request('GET', "https://economia.awesomeapi.com.br/last/{$origin}-{$target}");
        $currentQuote = json_decode($currentQuoteRequest->getBody()->getContents(), true);

        return $currentQuote[$origin . $target]['ask'];
    }
}
