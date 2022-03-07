<?php

namespace App\Services;

use App\Repositories\Contracts\ConversionRepositoryInterface;

class ConversionService
{
    private $conversionRepositoryInterface;

    public function __construct(ConversionRepositoryInterface $conversionRepositoryInterface)
    {
        $this->conversionRepositoryInterface = $conversionRepositoryInterface;
    }

    public function convert(array $conversionData)
    {
        $conversionResponse = $this->conversionRepositoryInterface->convert($conversionData);

        return $conversionResponse;
    }

    public function mountResult(array $dataToMountResult)
    {
        $result = (Object) [];
        # fazer as contas aqui e estruturar o retorno dos campos a serem exibidos
        $result->originCurrency = $dataToMountResult['originCurrency'];
        $result->destinyCurrency = $dataToMountResult['destinyCurrency'];
        $result->valueToConvert = $dataToMountResult['valueToConvert'];
        $result->paymentMethod = $dataToMountResult['paymentMethod'];
        $result->valueDestinyCurrencyConverted = self::calculateValueDestinyCurrencyConverted((Float) $dataToMountResult['valueDestinyCurrencyConverted']);
        $result->paymentFee = $dataToMountResult['paymentMethodFee'];
        $result->conversionFee = $dataToMountResult['conversionFee'];
        $fees = [$dataToMountResult['paymentMethodFee'], $dataToMountResult['conversionFee']];
        $result->valueUsedForConversionMinusFees = self::calculateValueUsedForConversionMinusFees($dataToMountResult['valueToConvert'], $fees);
        $result->destinyCurrencyBought = self::calculateDestinyCurrencyBought($result->valueUsedForConversionMinusFees, $result->valueDestinyCurrencyConverted); //valor comprado em "Moeda de destino"
        $result->originCurrencyDescription = self::originCurrencyDescription($dataToMountResult['originCurrency']);
        $result->destinyCurrencyDescription = self::destinyCurrencyDescription($dataToMountResult['destinyCurrency']);

        return $result;
    }

    public function paymentMethodFeeValue($value, $paymentMethod)
    {
        switch ($paymentMethod) {
            case 'billet':
                $billetFee = 1.45; 
                
                break;
            
            case 'credit_card':
                $billetFee = 7.63; 
                break;
        }

        return self::calculatePaymentMethodFeeValue($value, $billetFee);
    }

    private function calculatePaymentMethodFeeValue($value, $billetFee)
    {
        $valueWithFee = $value * ($billetFee / 100);
        return $valueWithFee;
    }

    public function conversionFeeValue($value)
    {
        switch ($value) {
            case $value < 3000:
                $percentToDiscount = 2;
                break;
            
            default:
                $percentToDiscount = 1;
                break;
        }

        return self::calculateConversionFee($value, $percentToDiscount);
    }

    private function calculateConversionFee($value, $percentToDiscount)
    {
        $valueWithFee = $value * ($percentToDiscount / 100);
        return $valueWithFee;
    }

    private function calculateValueDestinyCurrencyConverted(float $valueDestinyCurrencyConverted)
    {
        $result = round(1 / $valueDestinyCurrencyConverted, 2);
        return $result;
    }

    private function calculateDestinyCurrencyBought($valueUsedForConversionMinusFees, $valueDestinyCurrencyConverted)
    {   
        $destinyCurrencyBought = round($valueUsedForConversionMinusFees / $valueDestinyCurrencyConverted, 2);
    
        return $destinyCurrencyBought;
    }

    private function calculateValueUsedForConversionMinusFees($valueToConvert, array $fees)
    {
        $sumFees = array_sum($fees);
        return round($valueToConvert - $sumFees, 2);
    }

    private function originCurrencyDescription(string $originCurrencyCode)
    {
        $currencyList = $this->conversionRepositoryInterface->getCurrencyDescriptionList();
        return $currencyList->{$originCurrencyCode};
    }

    private function destinyCurrencyDescription(string $destinyCurrencyCode)
    {
        $currencyList = $this->conversionRepositoryInterface->getCurrencyDescriptionList();
        return $currencyList->{$destinyCurrencyCode};
    }
}
