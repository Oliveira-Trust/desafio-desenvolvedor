<?php

namespace App\Services\Strategies;

use App\Services\Order;

class Fee
{
    public function __construct($orderFee)
    {
        $this->strategy = $orderFee;
        $this->fee = null;
    }

    public function calculate(Order $order): void
    {
        $order->setPaymentFee($this->strategy->calculetePayment($order));
        $order->setExchangeFee($this->strategy->calculeteExchange($order));
    }
}