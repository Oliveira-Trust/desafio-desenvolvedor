<?php

namespace App\Services;

use GuzzleHttp\Client;

class CurrencyQuoteClientService
{
    const PROTOCOL = 'https://';
    const DOMAIN = 'economia.awesomeapi.com.br';
    const URI = '/last/';
    public function __construct(private Client $client)
    {
    }

    public function getLastAks(string $origin, string $target): float
    {
        $uri = self::PROTOCOL . self::DOMAIN . self::URI . $origin . '-' . $target;

        $request = $this->client->request('GET', $uri);

        $currentQuoteList = json_decode($request->getBody()->getContents(), true);

        return $currentQuoteList[$origin . $target]['ask'];
    }
}
