<?php

namespace App\Services;

use App\Exceptions\HttpException;
use GuzzleHttp\Exception\GuzzleException;

class CurrencyService extends Service
{
    /**
     * @throws HttpException
     */
    public function availables()
    {
        try {
            $request = \AwesomeApi::request('GET', 'json/available/uniq');
            return $this->deserialize($request->getBody());
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseObject = $this->deserialize($responseBodyAsString);

            throw new HttpException($responseObject['message'], $responseObject['status']);
        }
    }

    /**
     * @throws HttpException
     */
    public function lastQuotation(array $combination)
    {
        try {
            $combinationString = implode('-', $combination);
            $request = \AwesomeApi::request('GET', 'json/last/'.$combinationString);

            return $this->deserialize($request->getBody());
        } catch (GuzzleException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $responseObject = $this->deserialize($responseBodyAsString);

            throw new HttpException($responseObject['message'], $responseObject['status']);
        }
    }
}
