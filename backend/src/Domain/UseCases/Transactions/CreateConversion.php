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
        int $userId = null,
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
    public function execute(): array
    {
        $transaction = new Transaction();
        if ($this->userId) {
            $user = $this->userRepository->getById($this->userId);
            if($user){
                $transaction->setUser($user);
            }
        }
        if(!$this->data['moeda_origem']) {
            throw new \Exception("Moeda de origem não informada.");
        }
        if(!$this->data['moeda_destino']) {
            throw new \Exception("Moeda de destino não informada.");
        }
        if(!$this->data['valor']) {
            throw new \Exception("Valor para conversão não informada.");
        }
        $code = $this->data['moeda_origem'] . '-' . $this->data['moeda_destino'];
        $paymentId = $this->data['forma_pagamento'];
        $value = $this->data['valor'];
        $curencyOrigin = $this->currencyRepository->getByCurrencyCode($code);
        $transaction->setOriginCurrency($curencyOrigin);        
        $paymentType = $this->paymentRepository->getById($paymentId);
        $transaction->setPaymentType($paymentType);
        var_dump($transaction->getPaymentType());
        exit;

        $transaction->setValue((float)$value);
        $valueTax = $transaction->convertValue();
        $this->transactionRepository->save($transaction);
        return [
            'moeda_origem' => $this->data['moeda_origem'],
            'moeda_destino' => $this->data['moeda_destino'],
            'valor_conversao' => $this->data['valor'],
            'forma_pagamento' => $paymentType,
        ];
    }
}
