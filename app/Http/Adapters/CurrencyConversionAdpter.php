<?php

declare(strict_types=1);

namespace App\Http\Adapters;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CurrencyConversionRequest;

class CurrencyConversionAdpter
{
    protected string $originCurrency;

    protected string $destinyCurrency;

    protected string $valueCurrency;

    protected string $formPayment;

    protected float $valueDestinyCurrency;

    protected float $valueAcquiredInTheConversation;

    protected float $valueUsedForConversion;

    protected float $paymentRate;

    protected float $conversionRate;

    public function __construct(CurrencyConversionRequest $request)
    {
        $this->originCurrency   = $request->input('originCurrency');
        $this->destinyCurrency  = $request->input('destinyCurrency');
        $this->valueCurrency    = $request->input('valueCurrency');
        $this->formPayment      = $request->input('formPayment');
    }

    /** @return string[] */
    public function adapt(): array
    {
        return [
            'origin_currency'                       => $this->originCurrency(),
            'destiny_currency'                      => $this->getDestinyCurrency(),
            'value_currency'                        => $this->getValueCurrency(),
            'form_payment'                          => $this->getFormPayment(),
            'value_destiny_currency'                => $this->getValueDestinyCurrency(),
            'payment_rate'                          => $this->getPaymentRate(),
            'conversion_rate'                       => $this->getConversionRate(),
            'value_acquired_in_the_conversation'    => $this->getValueAcquiredInTheConversation(),
            'value_used_for_conversion'             => $this->getValueUsedForConversion(),
            'user_id'                               => Auth::user()->id
        ];
    }

    public function originCurrency(): string
    {
        return $this->originCurrency;
    }

    public function getDestinyCurrency(): string
    {
        return $this->destinyCurrency;
    }

    public function getValueCurrency(): float
    {
        return formatMoney($this->valueCurrency);
    }

    public function getFormPayment(): string
    {
        return $this->formPayment;
    }

    public function getValueDestinyCurrency(): float
    {
        return $this->valueDestinyCurrency;
    }

    public function setValueDestinyCurrency(float $value): void
    {
        $this->valueDestinyCurrency = $value;
    }

    public function getPaymentRate(): float
    {
        return $this->paymentRate;
    }

    public function setPaymentRate(float $value): void
    {
        $this->paymentRate = $value;
    }

    public function getConversionRate(): float
    {
        return $this->conversionRate;
    }

    public function setConversionRate(float $value): void
    {
        $this->conversionRate = $value;
    }

    public function getValueAcquiredInTheConversation(): float
    {
        return $this->valueAcquiredInTheConversation;
    }

    public function setValueAcquiredInTheConversation(float $value): void
    {
        $this->valueAcquiredInTheConversation = $value;
    }

    public function getValueUsedForConversion(): float
    {
        return $this->valueUsedForConversion;
    }

    public function setValueUsedForConversion(float $value): void
    {
        $this->valueUsedForConversion = $value;
    }
}
