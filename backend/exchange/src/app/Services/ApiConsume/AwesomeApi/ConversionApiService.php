<?php

namespace App\Services\ApiConsume\AwesomeApi;

use App\Services\ApiConsume\AwesomeApi\DTO\CurrencyData;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ConversionApiService extends BaseApiService {

    public function __construct(?string $baseUrl=null) {
        $this->baseUrl = $baseUrl ?? config('microservices.exchange_rate_check.awesome_api_url');
    }

    public function getCurrencyExchange(string $origin_currency_code, string $destiny_currency_code,): CurrencyData {
        $response = $this->requestJson(
            method: 'GET',
            requestUrl: "{$destiny_currency_code}-{$origin_currency_code}"
        );

        if (!is_array($response) || !count($response)) {
            throw new HttpException(422, "Conversão indisponível no momento.");
        }

        return CurrencyData::from(Arr::first($response));
    }

}
