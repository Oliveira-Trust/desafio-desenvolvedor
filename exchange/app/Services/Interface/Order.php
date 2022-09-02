<?php
namespace App\Services\Interface;

interface Order
{
    public function getAmount(): float;
    public function getMethod(): string;
    public function setPaymentFee(float $fee): Order;
    public function setExchangeFee(float $fee): Order;
}