<?php

namespace CurrencyConverter\Domain\Currency\Repositories;


use CurrencyConverter\Domain\Currency\Models\QuotationHistory;

/**
 * Interface CurencyInterface
 * @package CurrencyConverter\Domain\Currency\Services
 */
interface QuotationHistoryInterface
{
    public function save(array $data) : QuotationHistory;
}
