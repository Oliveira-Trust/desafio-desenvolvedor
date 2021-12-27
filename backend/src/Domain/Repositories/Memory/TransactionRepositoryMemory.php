<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Memory;

use App\Domain\Contracts\Repository\TransactionRepositoryInterface;
use App\Domain\Entities\Transaction;

class TransactionRepositoryMemory implements TransactionRepositoryInterface
{
    private $transactions;
    public function __construct()
    {
        $this->transactions = [];
    }
    public function getById(int $id):? Transaction
    {
        foreach($this->transactions as $key => $transaction) {
            if($key == $id) {
                return $transaction;
            }
        }
        return null;
    }
    public function getAll(): array
    {
        return $this->transactions;
    }
    public function getByUser(int $id): array
    {
        $response = [];
        foreach($this->transactions as $transaction) {
            $user = $transaction->getUser();
            if($user->getId() == $id) {
                $response[] = $transaction;
            }
        }
        return $response;
    }
    public function getByStatus(string $status):? Transaction
    {
        foreach($this->transactions as $transaction) {
            if($transaction->getStatus() === $status) {
                return $transaction;
            }
        }
        return null;
    }
    public function save(Transaction $transaction): Transaction
    {
        $key = count($this->transactions) + 1;
        $this->transactions[$key] = $transaction;
        return $transaction;
    }
}