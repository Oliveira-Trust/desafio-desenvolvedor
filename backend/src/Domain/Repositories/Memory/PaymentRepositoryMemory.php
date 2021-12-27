<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Memory;

use App\Domain\Contracts\Repository\PaymentRepositoryInterface;
use App\Domain\Entities\Payment;

class PaymentRepositoryMemory implements PaymentRepositoryInterface
{
    private $payments;
    public function __construct()
    {
        $this->payments = [];
    }
    public function getById(int $id):? Payment
    {
        foreach($this->payments as $key => $payment) {
            if($key === $id) {
                return $payment;
            }
        }
        return null;
    }
    public function getByType(string $type):? Payment
    {
        foreach($this->payments as $key => $payment) {
            if($payment->getType() === $type) {
                return $payment;
            }
        }
        return null;
    }
    public function getAll(): array
    {
        return $this->payments;
    }
    public function save(Payment $payment): Payment
    {
        $id = count($this->payments) +1;
        $this->payments[$id] = $payment;
        return $payment;
    }
}