<?php

declare(strict_types=1);

namespace App\Domain\UseCases\Transactions;

use App\Domain\Entities\Transaction;
use App\Domain\Contracts\Repository\UserRepositoryInterface;
use App\Domain\Contracts\Repository\CurrencyRepositoryInterface;
use App\Domain\Contracts\Repository\PaymentRepositoryInterface;
use App\Domain\Contracts\Repository\TransactionRepositoryInterface;

class CreateConversion
{
    private $data;
    private $userId;
    private $transactionRepository;
    private $currencyRepository;
    private $paymentRepository;
    private $userRepository;

    public function __construct(
        array $data,
        int $userId,
        TransactionRepositoryInterface $transactionRepository,
        CurrencyRepositoryInterface $currencyRepository,
        PaymentRepositoryInterface $paymentRepository,
        UserRepositoryInterface $userRepository
    ) {
        $this->data = $data;
        $this->userId = $userId;
        $this->transactionRepository = $transactionRepository;
        $this->currencyRepository = $currencyRepository;
        $this->paymentRepository = $paymentRepository;
        $this->userRepository = $userRepository;
    }
    public function execute(): Transaction
    {
        $transaction = new Transaction();
        if ($this->userId) {
            $user = $this->userRepository->getById($this->userId);
        }
        
        return $transaction;
    }
}
