<?php

namespace App\Services\ApiConsume;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Spatie\LaravelData\Data;

abstract class BaseApiService {

    protected string $baseUrl = '';

    protected string|null $authorization = null;

    public function requestJson($method, $requestUrl, $data = [], $headers = []) {

        $response = $this->request(
            method: $method,
            requestUrl: $requestUrl,
            data: $data,
            headers: $headers
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    public function request($method, $requestUrl, $data = [], $headers = []):ResponseInterface {

        if ($data instanceof Data) {
            $data = $data->toArray();
        }

        if (isset($this->authorization)) {
            $headers['Authorization'] = $this->authorization;
        }

        $client = app(Client::class, [
            'config' => [
                'base_uri' => $this->baseUrl,
            ],
        ]);

        $response = $client->request($method, $requestUrl,
            [
                'form_params' => $data,
                'headers'     => $headers,
            ]
        );

        return $response;
    }

}
