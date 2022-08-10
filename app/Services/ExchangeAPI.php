<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExchangeAPI
{

    private string $base_path = 'https://economia.awesomeapi.com.br';

    /**
     * @throws \Exception
     */
    public function getCurrentBid(string $source, string $target): \Exception|float
    {
        try {

            $combination = $source . '-' . $target;

            $this->checkIsAvailable($combination);

            $url = $this->base_path . '/json/last/' . $combination;

            return Http::get($url)["{$source}{$target}"]['bid'];

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());

        }
    }

    protected function checkIsAvailable($combination) {
        // todo: implement a cache system
        try {
            // this request should be made only once per hour
            $url = $this->base_path . '/json/available';
            $response = Http::get($url);
            $available_compbinations = json_decode($response->body(), true);

            if(!in_array($combination, array_keys($available_compbinations))) {
                throw new \Exception($combination . ' is not available');
            }

            return true;

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());

        }
    }

    public function getTypes() {
        // todo: implement a cache system
        try {
            // this request should be made only once per hour
            $url = $this->base_path . '/json/available/uniq';
            return Http::get($url);

        } catch (\Exception $e) {

            throw new \Exception($e->getMessage());

        }
    }

}
