<?php

namespace App\Services;

use App\Abstracts\AbstractBaseService as BaseService;
use App\Services\CurrencyService;
use App\Services\PaymentService;
use App\Services\HistoricService;
use App\Apis\CurrencyConversionApi\CurrencyConversionApi;
use Symfony\Component\HttpFoundation\Response as HttpStatusCode;

class CurrencyConversionService extends BaseService
{
    private $currencyService;
    private $paymentService;
    private $hitoricService;
    private $currencyConversionApi;
    private $porcent        = 100;
    private $valueFeeLimit  = 3000;
    private $percentFeeLess = 1;
    private $percentFeePlus = 2;

    
    public function __construct(
        CurrencyService $currencyService,
        PaymentService $paymentService,
        HistoricService $hitoricService,
        CurrencyConversionApi $currencyConversionApi
    ) {
        $this->currencyService       = $currencyService;
        $this->paymentService        = $paymentService;
        $this->hitoricService        = $hitoricService;
        $this->currencyConversionApi = $currencyConversionApi;
    }

    /**
     * @param array $data
     * @return array
     */
    public function currencyConversion(array $data): ?array
    {
        try {
            return $this->conversionCalculator($data);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function conversionCalculator(array $data): array
    {
        $currencyValue       = floatval($data['currency_value']);
        $payment             = $this->paymentService->find($data['payment']);
        $originCurrency      = $this->currencyService->find($data['origin_currency']);
        $destinationCurrency = $this->currencyService->find($data['destination_currency']);
        $conversionFeeValue  = $currencyValue >= $this->valueFeeLimit ? $this->percentFeeLess : $this->percentFeePlus;

        $destinationCurrencyValue = $this->getValueConversion(
            $originCurrency->name,
            $destinationCurrency->name
        );

        $paymentFee      = $currencyValue * floatval($payment->fee) / $this->porcent;
        $conversionFee   = $currencyValue * $conversionFeeValue / $this->porcent;
        $conversionValue = $currencyValue - $paymentFee - $conversionFee;
        $purchasedValue  = $conversionValue / $destinationCurrencyValue;

        $result = [
            'origin_currency'            => $originCurrency->name,
            'destination_currency'       => $destinationCurrency->name,
            'currency_value'             => number_format($currencyValue, 2, ',', '.'),
            'payment'                    => $payment->name,
            'destination_currency_value' => number_format($destinationCurrencyValue, 2, ',', '.'),
            'purchased_value'            => number_format($purchasedValue, 2, ',', '.'),
            'payment_fee'                => number_format($paymentFee, 2, ',', '.'),
            'conversion_fee'             => number_format($conversionFee, 2, ',', '.'),
            'conversion_value'           => number_format($conversionValue, 2, ',', '.'),
        ];

        $this->saveHistoric($result, $payment->fee);
        return $result;
    }

    /**
     * @param array $data
     * @param string $fee
     * @return void
     */
    private function saveHistoric(array $data, string $fee)
    {
        $data['user_id'] = 1;
        $data['fee']     = $fee;
        
        $this->hitoricService->create($data);
    }

    /**
     * @param string $originCurrency
     * @param  string $destinationCurrency
     * @return float
     */
    private function getValueConversion(string $originCurrency, string $destinationCurrency): ?float
    {
        $currencyValue = 0;
        $key = $destinationCurrency . $originCurrency;

        $result = $this->currencyConversionApi->getCurrencyConversion(
            $originCurrency,
            $destinationCurrency
        );

        if (isset($result['statusCode']) && $result['statusCode'] === HttpStatusCode::HTTP_OK) {
            $currencyValue = $result['body'][$key]['ask'];
        }

        return $currencyValue;
    }
}
