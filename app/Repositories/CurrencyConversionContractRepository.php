<?php

namespace App\Repositories;

interface CurrencyConversionContractRepository
{
    public function convert(array $pairs = []): array;
}
