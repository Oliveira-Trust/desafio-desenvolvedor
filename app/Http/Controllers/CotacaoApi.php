<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class CotacaoApi extends Controller
{
    protected $header;
    protected $client;
    protected $url;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = config('api.urls.base');
    }

    /**
     * @param  string $moedaOrigem
     * @param  string $moedaDestino
     * @return array
     */
    public function getCotacaoValor(string $moedaOrigem, string $moedaDestino): array
    {
        $this->url .= $moedaDestino . '-' . $moedaOrigem;
        return $this->request([], 'get');
    }

    /**
     * @param array $data
     * @param string $method
     * @return array
     */
    private function request(array $data, string $method): array
    {
        $result = [
            "body"       => [],
            "statusCode" => "",
        ];

        try {
            $response = $this->client->{$method}($this->url, [
                'http_errors' => false,
                'headers'     => $this->header,
                'debug'       => false,
                'body'        => json_encode($data),
            ]);

            if (in_array($response->getStatusCode(), [Response::HTTP_OK, Response::HTTP_CREATED])) {
                $result["body"] = $response->getBody()->getContents();
            }

            $result["statusCode"] = $response->getStatusCode();

            if (
                $result["body"] &&
                is_string($result["body"]) &&
                is_array(json_decode($result["body"], true))
                && (json_last_error() === JSON_ERROR_NONE)
            ) {
                $result["body"] = json_decode($result["body"], true);
            }
        } catch (\Exception $e) {
            $result["statusCode"] = Response::HTTP_INTERNAL_SERVER_ERROR;
        }
        return $result;
    }
}
