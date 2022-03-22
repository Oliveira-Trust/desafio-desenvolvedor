<?php

namespace App\Services;

use App\Factories\PaymentTypeFactory;
use App\Models\BuyCurrencyModel;
use App\Models\PaymentType\PaymentType;
use App\Services\CurrencyAPIService\AvailabilityCurrencyApiService;
use App\Services\CurrencyAPIService\CurrencyConvertionAPIService;
use Illuminate\Support\Facades\Auth;

class CurrencyService
{
    const DEFAULT_CURRENCY_ORIGIN = 'BRL';
    const DEFAULT_CURRENCY_DESTINATION_USD = 'USD';
    const DEFAULT_CURRENCY_DESTINATION_EUR = 'EUR';

    const DEFAULT_MIN_VALUE = 1000;
    const DEFAULT_MAX_VALUE = 100000;

    private $availableExternalService = false;
    private $availabilityCurrencyApiService;
    private $currencyConvertionAPIService;
    private $paymentTypeFactory;

    public function __construct(
        AvailabilityCurrencyApiService $availabilityCurrencyApiService,
        CurrencyConvertionAPIService $currencyConvertionAPIService,
        PaymentTypeFactory $paymentTypeFactory
    )
    {
        $this->availabilityCurrencyApiService = $availabilityCurrencyApiService;
        $this->currencyConvertionAPIService = $currencyConvertionAPIService;
        $this->paymentTypeFactory = $paymentTypeFactory;
    }

    public function formapPaymentType()
    {
        return PaymentType::findAll()->map(function($payment) {
            return [
                'value' => $payment->getReadableName(),
                'id' => $payment->getSlug(),
            ];
        });
    }

    public function isAvaibleExternalService(): bool
    {
        return $this->availableExternalService
            || config('services.currency-api.enabled', false);
    }

    public static function getDefaultCurrencyDestinations(): array
    {
        return  [
            self::DEFAULT_CURRENCY_DESTINATION_EUR,
            self::DEFAULT_CURRENCY_DESTINATION_USD,
        ];
    }

    public function getPossibleCurrencyOptionsTo(string $originCurrency = 'BRL'): array
    {
        if (!$this->isAvaibleExternalService()) {
            return $this::getDefaultCurrencyDestinations();
        }

        return $this->getAvailableOptionsOnServiceTo($originCurrency);
    }

    private function getAvailableOptionsOnServiceTo(string $originCurrency = 'BRL')
    {
        return $this->availabilityCurrencyApiService->request($originCurrency);
    }

    public static function getFloorValueToBuy(): int
    {
        return self::DEFAULT_MIN_VALUE;
    }

    public static function getCeilValueToBuy(): int
    {
        return self::DEFAULT_MAX_VALUE;
    }

    public function buy(BuyCurrencyModel $buyCurrencyModel)
    {
        $convertionFee = $this->extractConvertionFee($buyCurrencyModel->value);
        $buyCurrencyModel->convertion_fee = $convertionFee;
        $buyCurrencyModel->save();
        $paymentFee = $this->extractPaymentFee(
                $buyCurrencyModel->value,
                $buyCurrencyModel->payment_type
            );

        $buyCurrencyModel->payment_fee = $paymentFee;
        $buyCurrencyModel->save();
        $valueBeforeExchange = $buyCurrencyModel->value
            - $convertionFee
            - $paymentFee;

        $currentCotation = $this->currencyConvertionAPIService->request($buyCurrencyModel);
        $buyCurrencyModel->selling_price = MoneyFormatterService::round($valueBeforeExchange / $currentCotation);
        $buyCurrencyModel->user()->associate(Auth::user() ?? null);
        $buyCurrencyModel->save();

        return $buyCurrencyModel;
    }

    /** @todo quando for passar para bd retirar static */
    public static function extractConvertionFee(float $value): float
    {
        /** @todo passar para o bd as regras */
        if ($value < 3000) {
            return MoneyFormatterService::round($value * .02);
        }

        if ($value > 3000) {
            return MoneyFormatterService::round($value * .01);
        }

        return 0;
    }

    public function extractPaymentFee(
        float $value,
        string $paymentSlugType
    ): float {
        return MoneyFormatterService::round($value
            * $this->paymentTypeFactory
                ->bySlug($paymentSlugType)
                ->getTax());
    }

}