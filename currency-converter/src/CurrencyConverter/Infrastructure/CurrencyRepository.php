<?php

namespace CurrencyConverter\Infrastructure;


use CurrencyConverter\Domain\Currency\Repositories\CurrencyInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Collection;

/**
 * Class CurrencyRepository
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class CurrencyRepository implements CurrencyInterface
{
    public function findAvailablesCombinations(): Collection
    {
        $collection = new Collection();

        try {
            $response = Http::accept('application/xml')->get('https://economia.awesomeapi.com.br/xml/available')
                                                                  ->throw()
                                                                  ->body();

            $xmlData = simplexml_load_string($response);
            $jsonData = json_encode($xmlData );
            $data = json_decode($jsonData,TRUE);

            $filteredData = array_filter(
                $data,
                fn ($key) => substr($key, 0, strlen('BRL-')) === 'BRL-',
                ARRAY_FILTER_USE_KEY
            );

            $collection = collect($filteredData);
        }catch(\Exception $e)
        {
            throw new $e;
        }

        return $collection;
    }
}
