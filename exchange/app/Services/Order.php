<?php

namespace App\Services;

class Order
{
    private string $id;
    private string $source;
    private string $target;
    private float $amount;
    private string $method;
    private bool $private;
    private string $status;
    private string $token;
    private float $targetValue;
    private float $paymentFee;
    private float $exchangeFee;
    private float $targetAmount;
    private float $targetTotal;
    private string $targetPrefix;
    private string $sourcePrefix;

    public function __construct(string $source, string $target, float $amount, string $method )
    {
        $this->id = md5(uniqid(rand(), true));
        $this->source = $source ?? 'BRL';
        $this->target = $target;
        $this->amount = $amount;
        $this->method = $method;
        $this->private = FALSE;
        $this->status = "started";
        $this->token = md5(uniqid(rand(), true));
        $this->targetValue = 0.0;
        $this->paymentFee = 0.0;
        $this->exchangeFee = 0.0;
        $this->targetAmount = 0.0;
        $this->targetTotal = 0.0;
        $this->targetPrefix = "";//
        $this->sourcePrefix = "";//
    }

    public function getPaymentFee(): float
    {
        return $this->paymentFee;
    }
    public function getExchangeFee(): float
    {
        return $this->exchangeFee;
    }
    public function getAmount(): float
    {
        return $this->amount;
    }
    public function getTarget(): string
    {
        return $this->target;
    }
    public function getTargetAmount(): string
    {
        return $this->targetAmount;
    }
    public function getTargetValue(): string
    {
        return $this->targetValue;
    }
    public function getSource(): string
    {
        return $this->source;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setPaymentFee(float $fee)
    {
        $this->paymentFee = $fee;
    }

    public function setExchangeFee(float $fee)
    {
        $this->exchangeFee = $fee;
    }

    public function setTargetValue(float $value)
    {
        $this->targetValue = $value;
    }

    public function setTargetAmount(float $value)
    {
        $this->targetAmount = $value;
    }

    public function setTargetPrefix(string $value)
    {
        $this->targetPrefix = $value;
    }

    public function setSourcePrefix(string $value)
    {
        $this->sourcePrefix = $value;
    }

    public function setTargetTotal(float $value)
    {
        $this->targetTotal = $value;
    }

    public function setToken(string $value)
    {
        $this->token = $value;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function result(): array
    {
        return [
            'source_currency' => $this->source,
            'target_currency' => $this->target,
            'source_amount' => $this->amount,
            'method' => $this->method,
            'target_value' => $this->targetValue,
            'payment_tax' => $this->paymentFee,
            'exchange_tax' => $this->exchangeFee,
            'target_amount' => $this->targetAmount,
            'target_total' => $this->targetTotal,
            'target_prefix' => $this->targetPrefix,
            'source_prefix' => $this->sourcePrefix,
        ];
    }
    
}