<?php

namespace App\Strategies\Taxes;

use App\Contracts\CurrencyConversionDtoContract;
use App\Contracts\TaxContract;
use App\Services\ConversionTaxService;

class ConversionTaxStrategy implements TaxContract
{
    public function execute(CurrencyConversionDtoContract $currencyConversionDto): CurrencyConversionDtoContract
    {
        $conversionValue = $currencyConversionDto->getConversionValue();

        $tax = ConversionTaxService::fromValue($conversionValue);
        $tax = $conversionValue * $tax;
        $currencyConversionDto->setConversionTax($tax);

        $convertableValue = $currencyConversionDto->getConvertableValue();
        $convertableValue = $convertableValue - $tax;
        $currencyConversionDto->setConvertableValue($convertableValue);

        return $currencyConversionDto;
    }
}
