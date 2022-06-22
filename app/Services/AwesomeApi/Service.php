<?php

namespace App\Services\AwesomeApi;

use GuzzleHttp\Client as GuzzleClient;
use App\Services\AwesomeApi\Exceptions\AwesomeSDKException;

class Service extends Client
{
    const BASE_API_URL = 'https://economia.awesomeapi.com.br/json/';

    /**
     * Service constructor.
     *
     */
    function __construct(GuzzleClient $awesomeClient)
    {
        parent::__construct($awesomeClient);
    }

    /**
     * @return array
     * @throws AwesomeSDKException
     */
    public function getAvaliableCurrencies()
    {
        $url = self::BASE_API_URL . 'available';

        $rawResponse = $this->send($url, 'GET');

        if ($rawResponse->getStatusCode() != 200) {
            throw new AwesomeSDKException('API unavailable!');
        }

        return json_decode($rawResponse->getBody()->getContents(), true);
    }

    /**
     * @param $currency
     * @param $source
     * @return array
     * @throws AwesomeSDKException
     */
    public function getCurrencyQuote($currency = 'USD', $source = 'BRL')
    {
        $code = $currency . '-' . $source;
        $url = self::BASE_API_URL . 'last/' . $code;

        $rawResponse = $this->send($url, 'GET');

        if ($rawResponse->getStatusCode() != 200) {
            throw new AwesomeSDKException('API unavailable!');
        }

        return json_decode($rawResponse->getBody()->getContents(), true)[$currency.$source];
    }
}
