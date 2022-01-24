<?php

declare(strict_types=1);

namespace App\Models;

use AwesomeApi\Models\Currency;

class Quote
{
    private Payment $payment;
    private Money $money;
    private ConversionRate $conversionRate;
    private Currency $currency;
    private float $price;

    public function __construct(
        Payment $payment,
        Money $money,
        ConversionRate $conversionRate,
        Currency $currency
    ) {
        $this->money = $money;
        $this->payment = $payment;
        $this->conversionRate = $conversionRate;
        $this->currency = $currency;
    }

    public function generate(): self
    {
        $this->price = $this->currency->getBid() * $this->getDiscountedValue();
        return $this;
    }

    private function getDiscountedValue(): float
    {
        return ($this->money->getMoney() - $this->payment->getValueFees()) - $this->conversionRate->getFees();
    }

    public function toArray(): array
    {
        return [
            'currency' => explode('/', $this->currency->getName())[1],
            'value' => $this->money->getMoney(),
            'methodPayment' => $this->payment::NAME,
            'priceCurrency' => $this->currency->getBid(),
            'finalValue' => $this->price,
            'methodPaymentFee' => $this->payment->getValueFees(),
            'conversionFee' => $this->conversionRate->getFees(),
            'discountedValue' => $this->getDiscountedValue()
        ];
    }
}
