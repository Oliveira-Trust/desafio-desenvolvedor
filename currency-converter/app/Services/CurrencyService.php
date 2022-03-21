<?php

namespace App\Services;

use App\Models\BuyCurrencyModel;
use App\Models\PaymentType\PaymentType;
use App\Services\CurrencyAPIService\AvailabilityCurrencyApiService;

class CurrencyService
{
    const DEFAULT_CURRENCY_ORIGIN = 'BRL';
    const DEFAULT_CURRENCY_DESTINATION_USD = 'USD';
    const DEFAULT_CURRENCY_DESTINATION_EUR = 'EUR';

    const DEFAULT_MIN_VALUE = 1000;
    const DEFAULT_MAX_VALUE = 100000;

    private $availableExternalService = false;
    private $availabilityCurrencyApiService;

    public function __construct(
        AvailabilityCurrencyApiService $availabilityCurrencyApiService,
    )
    {
        $this->availabilityCurrencyApiService = $availabilityCurrencyApiService;
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
        $buyCurrencyModel->save();
    }

}