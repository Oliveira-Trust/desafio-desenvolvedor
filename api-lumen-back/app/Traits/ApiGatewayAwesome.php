<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ApiGatewayAwesome
{
    protected $baseUrl;

    protected $client;

    public function __construct()
    {
        $this->baseUrl = "https://economia.awesomeapi.com.br/last/";
        $this->client = new Client();
    }

    public function getCurrentQuote(string $from, string $to)
    {
        $headerResponse = $from . $to;
        $response = $this->client->get($this->baseUrl . $from . "-" . $to);
        $stream = $response->getBody()->getContents();
        $json = json_decode($stream);

        return $json->$headerResponse->high;
    }
}
