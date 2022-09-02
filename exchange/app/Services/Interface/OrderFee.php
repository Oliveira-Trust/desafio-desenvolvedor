<?php
namespace App\Services\Interface;

use App\Services\Order;

interface OrderFee
{
    public function getFeeAmountHigth(): float;
    public function getFeeAmountLow(): float;
    public function getFeePaymentMethod(): float;
    public function calculetePayment($order): float;
    public function calculeteExchange($order): float;
}
