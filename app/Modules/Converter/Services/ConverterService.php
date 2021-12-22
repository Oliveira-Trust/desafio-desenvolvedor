<?php

namespace Converter\Services;

use AwesomeApi\Services\CurrencyService;
use Converter\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ConverterService
{
    public function __construct(
        protected CurrencyService $currencyService,
        protected PaymentRepository $paymentRepository
    )
    {
        
    }

    public function getCurrencies()
    {
        $currencies = Arr::except(
            (array) $this->currencyService->getCurrencies(),
            env('DEFAULT_CURRENCY')
        );

        return $currencies;
    }

    public function getCurrencyValue(string $currency) : mixed
    {
        $currencyValue = (array) $this->currencyService->currencyValue($currency);

        $currency = array_values($currencyValue)[0];

        if (!$currency) {
            return false;
        }

        return $currency;
    }

    public function convertWithRange(string $currency, float $value): mixed
    {
        $currencyValue = (array) $this->currencyService->currencyValue($currency);
        
        $currency = array_values($currencyValue)[0];
        
        if (!$currency) {
            return false;
        }

        return [
            'value' => $value / $currency->ask,
            'min' => env('MIN_PAYMENT_VALUE') * $currency->ask,
            'max' => env('MAX_PAYMENT_VALUE') * $currency->ask,
        ];
    }


    public function makePayment(array $data)
    {
        $currency = $this->getCurrencyValue($data['currency']);
        $data['currency_value'] = $currency->ask;
        return $this->paymentRepository->create($data);
    }
}