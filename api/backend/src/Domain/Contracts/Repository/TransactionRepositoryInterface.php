<?php

declare(strict_types=1);

namespace App\Domain\Contracts\Repository;

use App\Domain\Entities\Transaction;

interface TransactionRepositoryInterface
{
    public function getById(int $id):? Transaction;
    public function getAll(): array;
    public function getByUser(int $id): array;
    public function getByStatus(string $status):? Transaction;
    public function save(Transaction $transaction): Transaction;
}