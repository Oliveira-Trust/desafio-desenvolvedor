<?php
// app/Domain/Repositories/CurrencyRepositoryInterface.php

namespace App\Domain\Repositories;

interface CurrencyRepositoryInterface
{
    public function getCurrencyRate(string $baseCurrency, string $targetCurrency): float;
}
