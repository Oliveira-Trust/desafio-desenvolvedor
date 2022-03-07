<?php

namespace App\Repositories\AwesomeApi;

use App\Repositories\Contracts\ConversionRepositoryInterface;

use Illuminate\Support\Facades\Http;

class ConversionRepository implements ConversionRepositoryInterface
{
    CONST URL = 'https://economia.awesomeapi.com.br';

    public function convert(array $conversionData)
    {
        $url = self::URL.'/last/BRL-'.$conversionData['currencyToConvert'];

        $response = Http::get($url);
        $response = json_decode($response);

        return $response->{'BRL'.$conversionData['currencyToConvert']}->bid;
    }

    public function getCurrencyDescriptionList()
    {
        $url = self::URL.'/json/available/uniq';

        $response = Http::get($url);
        $response = json_decode($response);

        return $response;
    }
}
