<?php

namespace App\Services\Strategies;

use App\Services\Order;
use App\Services\OrderFee;

class FeeStrategy
{
    public function __invoke(Order $order)
    {
        return $order->getMethod() == "billet" ? new BilletFeeStrategy : new CreditCardFeeStrategy;
    }
}