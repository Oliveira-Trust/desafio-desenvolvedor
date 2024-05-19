<?php

namespace App\Builders;

use App\Models\Quote;

class QuoteBuilder
{
    protected $quote;
    protected $feeRules;

    public function __construct(array $feeRules)
    {
        $this->quote = new Quote();
        $this->feeRules = $feeRules;
    }

    public function setConversionAmount($amount)
    {
        $this->quote->conversion_amount = $amount;
        return $this;
    }

    public function setName($name)
    {
        $this->quote->name = $name;
        return $this;
    }

    public function setCurrencyOrigin($codein)
    {
        $this->quote->currency_origin = $codein;
        return $this;
    }

    public function setCurrencyName($code)
    {
        $this->quote->currency_name = $code;
        return $this;
    }

    public function setPaymentMethod($paymentMethod)
    {
        $this->quote->payment_method = $paymentMethod;
        return $this;
    }

    public function setFee($fee)
    {
        $this->quote->fee = $fee;
        return $this;
    }

    public function setCurrencyValue($bid)
    {
        $this->quote->currency_value = $bid;
        return $this;
    }

    public function calculateFees()
    {
        $this->quote->conversion_fee = $this->getConversionFee($this->quote->conversion_amount);
        $this->quote->payment_rate = $this->quote->conversion_amount * $this->quote->fee;
        $this->quote->conversion_rate = $this->quote->conversion_amount * $this->quote->conversion_fee;
        $this->quote->conversion_value = $this->quote->conversion_amount - $this->quote->payment_rate - $this->quote->conversion_rate;
        $this->quote->converted_amount = $this->quote->conversion_value / $this->quote->currency_value;
        return $this;
    }

    protected function getConversionFee($amount)
    {
        foreach ($this->feeRules as $rule) {
            if (($rule['rule'] === '<' && $amount < $rule['value']) ||
                ($rule['rule'] === '>=' && $amount >= $rule['value'])
            ) {
                return $rule['fee'];
            }
        }

        return 0;
    }

    public function build()
    {
        return $this->quote;
    }
}
