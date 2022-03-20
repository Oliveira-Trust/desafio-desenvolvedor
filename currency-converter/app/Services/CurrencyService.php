<?php

namespace App\Services;

use App\Models\PaymentType\PaymentType;

class CurrencyService
{
    const DEFAULT_CURRENCY_ORIGIN = 'BRL';
    const DEFAULT_CURRENCY_DESTINATION_USD = 'USD';
    const DEFAULT_CURRENCY_DESTINATION_EUR = 'EUR';

    private $availableExternalService = false;

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

        return $this::getDefaultCurrencyDestinations();
    }

}