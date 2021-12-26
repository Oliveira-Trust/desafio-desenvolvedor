<?php

namespace CurrencyConverter\Infrastructure;


use CurrencyConverter\Domain\Currency\Repositories\CurrencyInterface;
use Illuminate\Support\Collection;

/**
 * Class CurrencyRepository
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class CurrencyRepository implements CurrencyInterface
{
    public function findAvailablesCombinations(): Collection
    {
        dd(__METHOD__);
    }
}
