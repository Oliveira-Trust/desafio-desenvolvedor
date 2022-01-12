<?php

declare(strict_types=1);

namespace App\Domain\Currency\Services\Interfaces;

/**
 *
 */
interface CurrencyServiceInterface
{
    public function getAllCurrencyCodes():object;

    public function getCurrencyCode(int $currencyId):string;
}
