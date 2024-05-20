<?php

namespace App\Builders;

use App\Models\FeeRule;
use App\Models\Quote;

class QuoteBuilder
{
    protected $quote;
    protected $feeRules;

    public function __construct(FeeRule $feeRules)
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
        $this->quote->conversion_fee = $this->feeRules->getConversionFee($this->quote->conversion_amount);
        $this->quote->payment_rate = $this->quote->conversion_amount * $this->quote->fee;
        $this->quote->conversion_rate = $this->quote->conversion_amount * $this->quote->conversion_fee;
        $this->quote->conversion_value = $this->quote->conversion_amount - $this->quote->payment_rate - $this->quote->conversion_rate;
        $this->quote->converted_amount = $this->quote->conversion_value / $this->quote->currency_value;
        return $this;
    }

    public function build()
    {
        return $this->quote;
    }
}
