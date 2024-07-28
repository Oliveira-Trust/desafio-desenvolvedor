<?php

namespace App\Apis;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class AwesomeApi
{
    const PATH = '/last';
    const ORIGIN_CURRENCY = 'BRL';
    const TARGET_CURRENCY_1 = 'USD';
    const TARGET_CURRENCY_2 = 'EUR';
    public function getQuotation(): array
    {
        $client = new Client();

        $url = env('AWESOMEAPI_URL');
        $endpoint = self::PATH.'/'.self::TARGET_CURRENCY_1.'-'.self::ORIGIN_CURRENCY.','.self::TARGET_CURRENCY_2.'-'.self::ORIGIN_CURRENCY;
        $request = $url.$endpoint;

        try {
            $response = $client->request('GET', $request);

            return json_decode($response->getBody(), true);

        } catch (GuzzleException $e) {
            return array(['error' => $e->getMessage()], 500);
        }

    }
}
