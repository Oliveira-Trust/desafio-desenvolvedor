<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AweSomeApi extends Controller
{
    private $url = 'https://economia.awesomeapi.com.br/json';

    /**
     * Conversão de moeda
     *
     * @param String $currency_from
     * @param Array $currency_to
     * @return Array
     */
    public function conversionCurrency($currency_from, $currency_to)
    {

        $resources = [];

        foreach ($currency_to as $to) {
            array_push($resources, $currency_from . "-" . $to);
        }

        $resources = implode(",", $resources);

        $get = Http::get("{$this->url}/last/{$resources}");

        if ($get->status() == 200) {
            return $get->json();
        }

        return [];
    }
}
