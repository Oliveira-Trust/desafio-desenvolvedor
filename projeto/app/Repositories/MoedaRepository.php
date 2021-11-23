<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\TransferException;

class MoedaRepository
{
    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getMoeda($moeda){
        try {
            $response = json_decode($this->client->get('https://economia.awesomeapi.com.br/last/'.$moeda)->getBody(), true);
            if (!$response) {
                throw new \Exception();
            }
            return $response;
        } catch (TransferException $e) {
            throw new TransferException(null, null, $e);
        }
    }
}
