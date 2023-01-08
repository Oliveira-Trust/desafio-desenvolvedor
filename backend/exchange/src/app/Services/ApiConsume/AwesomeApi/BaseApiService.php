<?php

namespace App\Services\ApiConsume\AwesomeApi;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelData\Data;

abstract class BaseApiService {

    protected string $baseUrl = '';

    protected string|null $authorization = null;

    /**
     * @param       $method
     * @param       $requestUrl
     * @param array $data
     * @param array $headers
     *
     * @return string
     */
    public function requestJson($method, $requestUrl, $data = [], $headers = []) {

        if (isset($this->authorization)) {
            $headers['Authorization'] = $this->authorization;
        }

        if ($data instanceof Data) {
            $data = $data->toArray();
        }

        return Http::asJson()
                   ->baseUrl($this->baseUrl)
                   ->acceptJson()
                   ->send($method, $requestUrl, ['form_params' => $data, 'headers' => $headers,])
                   ->json();
    }

    public function getRequest($method, $requestUrl, $data = [], $headers = []): Response {

        if (isset($this->authorization)) {
            $headers['Authorization'] = $this->authorization;
        }

        return Http::acceptJson()->send($method, $requestUrl, [
            'form_params' => $data,
            'headers'     => $headers,
        ]);
    }

}
