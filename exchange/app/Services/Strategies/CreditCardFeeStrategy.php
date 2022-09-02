<?php 

namespace App\Services;
namespace App\Services\Strategies;

use App\Services\Order;
use App\Services\Interface\OrderFee;

class CreditCardFeeStrategy implements OrderFee
{
    private float $feeAmountHigth; 
    private float $feeAmountLow;
    private float $feePaymentMethod;
    private int $limitAmountFee;
    
    public function __construct()
    {
        $this->limitAmountFee = 3000;
        $this->feeAmountHigth = 1.0;
        $this->feeAmountLow = 2.0;
        $this->feePaymentMethod = 7.63;
    }

    public function getFeeAmountHigth(): float
    {
        return  $this->feeAmountHigth;
    }

    public function getFeeAmountLow(): float
    {
        return  $this->feeAmountLow;
    }

    public function getFeePaymentMethod(): float
    {
        return  $this->feePaymentMethod;
    }

    public function calculetePayment($order): float
    {
        return round($order->getAmount() * $this->feePaymentMethod / 100 , 2);
    }

    public function calculeteExchange($order): float
    {
        $amount = $order->getAmount();
        $fee = $amount < $this->limitAmountFee ? $this->feeAmountLow :  $this->feeAmountHigth; 
        return round($amount * $fee / 100, 2);
    }
}