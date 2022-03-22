<?php

namespace App\Services\CurrencyAPIService;

use App\Enums\HttpMethods;
use App\Models\BuyCurrencyModel;
use Illuminate\Support\Str;

class CurrencyConvertionAPIService extends CurrencyAPIService
{
    private $buyCurrencyModel;

    /** @var BuyCurrencyModel $payload */
    public function beforeRequest($payload)
    {
        $this->setBuyCurrency($payload);
        return $payload;
    }

    private function setBuyCurrency(BuyCurrencyModel $buyCurrencyModel)
    {
        $this->buyCurrencyModel = $buyCurrencyModel;
    }

    public function afterResponse($response)
    {
        if (empty($response)) {
            /** @todo criar exception especifica */
            throw new \Exception('No Response');
        }

        $response = array_values($response);

        /** na documentação aqui seria 'bid' pq eu estaria comprando */
        return $response[0]['bid'];
    }

    public function getMethod(): HttpMethods
    {
        return HttpMethods::GET;
    }

    public function getEndpoint(): string
    {
        $endpoint = config(parent::BASE_CONFIG . 'currency-convertion.endpoint');
        $endpoint = Str::replaceFirst(':originCurrency', $this->buyCurrencyModel->origin_currency, $endpoint);

        return Str::replaceFirst(':destinationCurrency', $this->buyCurrencyModel->destination_currency, $endpoint);
    }

    public function isEnable(): bool
    {
        return config(parent::BASE_CONFIG . 'currency-convertion.enabled');
    }
}