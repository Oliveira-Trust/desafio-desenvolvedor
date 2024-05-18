<?php

namespace App\Contracts;

interface TaxContract
{
    public function execute(CurrencyConversionDtoContract $CurrencyConversionDto): CurrencyConversionDtoContract;
}
