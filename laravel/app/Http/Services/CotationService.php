<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CotationService
{
    private Client $http;

    public function __construct()
    {
        $this->http = new Client([
            'verify' => false,
            'base_uri' => getenv('URL_API'),
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    /**
     * @throws GuzzleException
     */
    public function convertCoin($data)
    {
        $url = $data['currency_origin'] . "-" . $data['currency_buy'];
        $response = $this->http->request('GET', $url);
        $body = $response->getBody()->getContents();
        $body = json_decode($body);
        return $body[0];
    }


}
