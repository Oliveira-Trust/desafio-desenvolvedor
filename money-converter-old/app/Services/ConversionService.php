<?php

namespace App\Services;

class ConversionService
{
    private CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    /**
     * @throws \App\Exceptions\HttpException
     */
    public function conversionByCombination(array $combination, float $valueWitchTaxes): array
    {
        $combinationKey = implode('', $combination);

        $lastQuotation = $this->currencyService->lastQuotation($combination);
        $quotation = $lastQuotation[$combinationKey];

        $bidPrice = floatval($quotation['bid']);
        $convertedValue = $valueWitchTaxes * $bidPrice;

        return ['quotation' => $bidPrice, 'converted' => $convertedValue];
    }
}
