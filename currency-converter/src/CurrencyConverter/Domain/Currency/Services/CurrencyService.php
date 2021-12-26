<?php

namespace CurrencyConverter\Domain\Currency\Services;

use CurrencyConverter\Domain\Currency\Repositories\CurrencyInterface;
use Illuminate\Support\Collection;

/**
 * Class CurrencyService
 * @package CurrencyConverter\Domain\Currency\Services
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class CurrencyService
{
    private CurrencyInterface $currencyRepository;

    public function __construct(CurrencyInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @return Collection
     */
    public function listAvailablesCombinations() : Array
    {
        $data = $this->currencyRepository->findAvailablesCombinations();

        $items = [];
        foreach ( $data as $key => $value )
        {
            $newKey = \Str::replace('BRL-','', $key);
            $newValue = \Str::replace('BRL-','', $key).' - '.\Str::replace('Real Brasileiro/','', $value);

            $items[$newKey] = $newValue;
        }

        return \Arr::sort($items);
    }
}
