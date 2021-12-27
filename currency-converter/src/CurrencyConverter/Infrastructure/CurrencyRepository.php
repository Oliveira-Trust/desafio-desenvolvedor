<?php

namespace CurrencyConverter\Infrastructure;


use CurrencyConverter\Domain\Currency\Repositories\CurrencyInterface;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

/**
 * Class CurrencyRepository
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class CurrencyRepository implements CurrencyInterface
{
    private const BASE_URL = 'https://economia.awesomeapi.com.br/json';

    /**
     * @param string $resource
     * @return array
     * @throws RequestException
     */
    private function getResource(string $resource) : array
    {
        return Http::accept('application/json')->get(self::BASE_URL.$resource)
            ->throw()
            ->json();
    }

    public function findAvailablesCombinations(): Collection
    {
        try {
            $data = $this->getResource('/available');
        }catch (HttpRequestException $e){
            throw new $e;
        }

        $filteredData = array_filter(
            $data,
            fn ($key) => substr($key, 0, strlen('BRL-')) === 'BRL-',
            ARRAY_FILTER_USE_KEY
        );

        return collect($filteredData);
    }

    public function findQuotationFromBRLTo(string $currency) : array
    {
        try {
            return $this->getResource("/last/BRL-{$currency}");
        }catch (HttpRequestException $e){
            throw new $e;
        }
    }
}
