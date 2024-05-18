<?php

namespace App\Strategies\Taxes;

use App\Contracts\CurrencyConversionDtoContract;
use App\Contracts\TaxContract;

class PaymentMethodTaxStrategy implements TaxContract
{
    public function execute(CurrencyConversionDtoContract $currencyConversionDto): CurrencyConversionDtoContract
    {
        $conversionValue = $currencyConversionDto->getConversionValue();

        $tax = $currencyConversionDto->getPaymentMethod()->tax();
        $tax = $conversionValue * $tax;
        $currencyConversionDto->setPaymentTax($tax);

        $convertableValue = $currencyConversionDto->getConvertableValue();
        $convertableValue = $convertableValue - $tax;
        $currencyConversionDto->setConvertableValue($convertableValue);

        return $currencyConversionDto;
    }
}
