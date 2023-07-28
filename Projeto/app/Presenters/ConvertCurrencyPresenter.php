<?php
// app/Presenters/ConvertCurrencyPresenter.php

namespace App\Presenters;

use App\Domain\Entities\ConversionResult;

class ConvertCurrencyPresenter implements ConvertCurrencyPresenterInterface
{
    public function present(ConversionResult $conversionResult): array
    {
        return [
            'origin_currency' => $conversionResult->originCurrency,
            'target_currency' => $conversionResult->targetCurrency,
            'initial_amount' => $conversionResult->initialAmount,
            'converted_amount' => $conversionResult->convertedAmount,
            'conversion_fee' => $conversionResult->conversionFee,
            'payment_method_fee' => $conversionResult->paymentMethodFee,
            'total_fee' => $conversionResult->totalFee
        ];
    }
}
