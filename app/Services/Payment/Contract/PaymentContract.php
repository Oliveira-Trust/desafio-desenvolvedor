<?php

declare(strict_types=1);

namespace App\Services\Payment\Contract;

interface PaymentContract
{
    public function calculatePayRate(): float;
}
