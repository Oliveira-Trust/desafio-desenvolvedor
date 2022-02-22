<?php
namespace App\Apis\CurrencyConversionApi;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;
use App\Apis\CurrencyConversionApi\Enums\CurrencyConversionApiMethod as HttpMethod;

class CurrencyConversionApi
{
    protected $header;
    protected $client;
    protected $url;
    protected $routes;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->url = config('currencyconversionapi.urls.base');
        $this->routes = [
            'get_currency_conversion_last' => config('currencyconversionapi.urls.get_currency_conversion_last')
        ];
    }

    /**
     * @param  string $originCurrency
     * @param  string $destinationCurrency
     * @return array
     */
    public function getCurrencyConversion(string $originCurrency, string $destinationCurrency): array
    {
        $route = $this->routes['get_currency_conversion_last'] . $destinationCurrency . '-' . $originCurrency;
        return $this->request($route, [], HttpMethod::GET);
    }

    /**
     * @param string $route
     * @param array $data
     * @param string $method
     * @return array
     */
    private function request(string $route, array $data, string $method): array
    {
        $result = [
            "body"       => [],
            "statusCode" => "",
        ];

        $url = $this->url . $route;

        try {
            $response = $this->client->{$method}($url, [
                'http_errors' => false,
                'headers'     => $this->header,
                'debug'       => false,
                'body'        => json_encode($data),
            ]);

            if (in_array($response->getStatusCode(), [HttpStatusCode::HTTP_OK, HttpStatusCode::HTTP_CREATED])) {
                $result["body"] = $response->getBody()->getContents();
            }

            $result["statusCode"] = $response->getStatusCode();

            if ($result["body"] &&
                is_string($result["body"]) &&
                is_array(json_decode($result["body"], true))
                && (json_last_error() === JSON_ERROR_NONE)
            ) {
                $result["body"] = json_decode($result["body"], true);
            }
        } catch (\Exception $e) {
            $result["statusCode"] = HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR;
        }
        return $result;
    }
}
