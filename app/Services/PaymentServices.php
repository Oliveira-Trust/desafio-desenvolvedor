<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Payment;
use App\Repository\PaymentRepository;
use Illuminate\Support\Collection;

class PaymentServices
{
    private PaymentRepository $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getAll(): Collection
    {
        return $this->paymentRepository->findAll()->mapWithKeys(function (Payment $payment) {
            return [$payment->slug => $payment->name];
        });
    }
}
