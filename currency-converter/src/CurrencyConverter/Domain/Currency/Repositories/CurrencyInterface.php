<?php

namespace CurrencyConverter\Domain\Currency\Repositories;

use Illuminate\Support\Collection;

/**
 * Interface CurencyInterface
 * @package CurrencyConverter\Domain\Currency\Services
 */
interface CurrencyInterface
{
    /**
     * @return Collection
     */
    public function findAvailablesCombinations() : Collection;

    /**
     * @param string $currency
     * @return array
     */
    public function findQuotationFromBRLTo(string $currency) : array;
}
