<?php

namespace ExchangeRate\Providers;

use ExchangeRate\Mappers\CurrenciesMapper;
use ExchangeRate\Mappers\ExchangeRateMapper;
use GuzzleHttp\Client as ClientGuzzle;
use ExchangeRate\Models\ExchangeRate;

class ExchangeRateResourceProvider
{
    /**
     * @var ClientGuzzle;
     */
    private $clientGuzzle;
    private $currencies;
    /**
     * @var string
     */
    public static $source = 'https://economia.awesomeapi.com.br/';

    public function __construct()
    {
        $this->makeGuzzleClient();
    }

    /**
     * @param string $from
     * @param string $to
     * @return ExchangeRate|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getExchangeRate(string $from = 'BRL', string $to = 'USD')
    {
        $url = self::$source . "json/last/{$from}-{$to}";
        $result = $this->clientGuzzle->request('GET', $url);
        $result = $result->getBody()->getContents();
        $data = json_decode($result, true);
        $data = array_pop($data);
        if (json_last_error() === JSON_ERROR_NONE)
            return ExchangeRateMapper::map($data);
        return null;

    }

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getCurrenciesList()
    {
        $url = self::$source . "xml/available/uniq";
        $result = $this->clientGuzzle->request('GET', $url);
        $result = $result->getBody()->getContents();
        $this->currencies = $this->xmlToArray($result);
        return CurrenciesMapper::map($this->currencies);
    }

    protected function makeGuzzleClient()
    {
        $this->clientGuzzle = new ClientGuzzle([
            'max'             => 5,
            'strict'          => true,
            'referer'         => true,
            'protocols'       => ['http', 'https'],
            'allow_redirects' => true,
            'track_redirects' => true,
            'cookies'         => true
        ]);

    }

    /**
     * @param string $xml
     * @return array
     */
    protected function xmlToArray(string $xml)
    {
        $XML = simplexml_load_string($xml, "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($XML);
        $currencies = json_decode($json, TRUE);
        if (json_last_error() === JSON_ERROR_NONE)
            return $currencies;
        return [];

    }

    public static function getInstance()
    {
        return new ExchangeRateResourceProvider();
    }
}
