<?php

declare(strict_types=1);

namespace App\Domain\Contracts\Repository;

use App\Domain\Entities\Payment;

interface PaymentRepositoryInterface
{
    public function getById(int $id):? Payment;
    public function getByName(string $name):? Payment;
    public function getAll(): array;
    public function save(Payment $currency): Payment;
}