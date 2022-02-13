<?php

declare(strict_types=1);

namespace App\Services\Payment;

use Exception;
use App\Services\Payment\PaymentSlip;

class FormPayment
{
    /** @param string  */
    private const TICKET = 'Boleto';

    /** @param string  */
    private const CARD = 'Credito';

    protected float $value;

    protected string $typePayment;

    public function __construct(float $value, string $typePayment)
    {
        $this->value        = $value;
        $this->typePayment  = $typePayment;
        $this->percentage   = 1.45;
    }

    public function calculateformPayment(): float
    {
        if ($this->typePayment === self::TICKET) {
            return (new PaymentSlip($this->value))->calculatePayRate();
        }

        if ($this->typePayment === self::CARD) {
            return (new PaymentCard($this->value))->calculatePayRate();
        }

        throw new Exception('invalid payment method.');
    }
}
