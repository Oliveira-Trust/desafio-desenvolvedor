<?php

namespace App\Services;
use App\Exceptions\InvalidCurrencyException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CoinApiService
{
    private $coinApiClient;

    public function __construct()
    {
        $this->coinApiClient = new Client(['base_uri'=>env('COIN_API_URL')]);
    }

    public function getLastCotation($coin, $sourceCoin)
    {

        try{
            $stringBody = (string) $this->coinApiClient->get("last/{$coin}-{$sourceCoin}")->getBody();
            return json_decode($stringBody);
        } catch (GuzzleException $e) {
            if($e->getCode() == 404){
                throw new InvalidCurrencyException('The coin that you provide doesn`t exist');
            }
            throw $e;
        }
    }
}
