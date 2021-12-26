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
            $data = Http::accept('application/json')->get('https://economia.awesomeapi.com.br/json/available')
                                                                  ->throw()
                                                                  ->json();

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
