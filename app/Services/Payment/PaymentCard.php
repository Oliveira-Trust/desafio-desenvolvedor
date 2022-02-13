<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Services\Payment\Contract\PaymentContract;

class PaymentCard implements PaymentContract
{
    protected float $value;

    protected float $percentage;

    public function __construct(float $value)
    {
        $this->value        = $value;
        $this->percentage   = 7.63;
    }

    public function calculatePayRate(): float
    {
        return $this->value * ($this->percentage / 100);
    }
}
