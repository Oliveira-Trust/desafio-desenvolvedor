<?php

namespace App\Http\Application\UseCases;

use App\Domain\Repositories\ConversionRepositoryInterface;
use App\Http\Infrastructure\Service\ExchangeRatesService;
use App\Http\Infrastructure\Repositories\PaymentMethodRepository;

class ConversionUseCase
{
    /**
     * @var ConversionRepositoryInterface
     */    private ConversionRepositoryInterface $conversionRepositoryInterface;

    public function __construct(ConversionRepositoryInterface $conversionRepositoryInterface)
    {

        $this->conversionRepositoryInterface = $conversionRepositoryInterface;
    }

    public function execute(array $paramsToConversion)
    {
        $resonseOfGetExchangeRate = $this->getExchangeRate($paramsToConversion['destination_currency']);

        if ($resonseOfGetExchangeRate->ok()) {

            $conversionRate = $resonseOfGetExchangeRate['BRL' . $paramsToConversion['destination_currency']]['bid'];
            $conversionCalculations = $this->calculateConversion($paramsToConversion, $conversionRate);
            $paramsToConversion += $conversionCalculations;

            if (!isset($paramsToConversion['total_amount_destination_currency']))
                return response()->json(['error' => 'Failed to calculate conversion.'], 500);
            else
                return $this->conversionRepositoryInterface->create($paramsToConversion);
        } else {
            return response()->json(['error' => 'Failed to fetch conversion rate.'], 500);
        }
    }

    public function getConversionHistorybyUserId(int $userid): array
    {
        return $this->conversionRepositoryInterface->getConversionHistory($userid);
    }

    private function getExchangeRate($destinationCurrency): Object
    {
        $exchangeRateService = new ExchangeRatesService();

        return $exchangeRateService->getExchangeRates($destinationCurrency);
    }
    private function calculateConversion(array $paramsToConversion, float $conversionRate): array
    {
        $paymentRate = $this->getPaymentRate($paramsToConversion['payment_method_id']);
        if ($paymentRate >= 0)
            $paymentTax = $paramsToConversion['conversion_value'] * ($paymentRate / 100);
        else
            return [];


        $conversionFee = $paramsToConversion['conversion_value'] < 3000 ? $paramsToConversion['conversion_value'] * 0.02 : $paramsToConversion['conversion_value'] * 0.01;

        $totalValueOriginCurrency = $paramsToConversion['conversion_value'] - $paymentTax - $conversionFee;

        $ResponseToAppendtoParams['conversion_fee'] = $conversionFee;
        $ResponseToAppendtoParams['payment_tax'] = $paymentTax;
        $ResponseToAppendtoParams['total_amount_origin_currency'] = $totalValueOriginCurrency;
        $ResponseToAppendtoParams['total_amount_destination_currency'] = $totalValueOriginCurrency * $conversionRate;

        return $ResponseToAppendtoParams;
    }
    private function getPaymentRate(int $paymentMethodId): float
    {
        $paymentMethodRepository = new PaymentMethodRepository();
        return $paymentMethodRepository->getTax($paymentMethodId);
    }
}
