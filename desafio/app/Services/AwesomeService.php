<?php

namespace App\Services;

class AwesomeService
{
    /**
     * @var string
     */
    private $endpoint = 'https://economia.awesomeapi.com.br';

    /**
     * @var GuzzeleHTTPService $clientHTTP
     */
    private $clientHTTP;

    public function __construct()
    {
        $this->clientHTTP = new GuzzeleHTTPService($this->endpoint);
    }

    /**
     * Get quotation
     * @param string $codeIn
     * @return array
     */
    public function getQuote(string $codeIn)
    {
        return $this->clientHTTP->get("last/BRL-{$codeIn}");
    }

    /**
     * get quotes last 30 days 
     * @param string $currency
     * @return array
     */
    public function getQuotesByPeriod(string $currency)
    {
        return $this->clientHTTP->get("daily/{$currency}/30");
    }
}