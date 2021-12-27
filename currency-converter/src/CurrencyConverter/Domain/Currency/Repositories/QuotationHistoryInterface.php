<?php

namespace CurrencyConverter\Domain\Currency\Repositories;


use CurrencyConverter\Domain\Currency\Models\QuotationHistory;
use Illuminate\Support\Collection;

/**
 * Interface CurencyInterface
 * @package CurrencyConverter\Domain\Currency\Services
 */
interface QuotationHistoryInterface
{
    /**
     * @param array $data
     * @return QuotationHistory
     */
    public function save(array $data) : QuotationHistory;

    /**
     * @return Collection
     */
    public function list() : Collection;
}
