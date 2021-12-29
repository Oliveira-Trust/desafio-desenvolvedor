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

    public function __construct(array $data, int $userId = null, TransactionRepositoryInterface $transactionRepository, CurrencyRepositoryInterface $currencyRepository, PaymentRepositoryInterface $paymentRepository, UserRepositoryInterface $userRepository)
    {
        $this->paymentRepository = $paymentRepository;
        $this->data = $data;
        $this->userId = $userId;
        $this->transactionRepository = $transactionRepository;
        $this->currencyRepository = $currencyRepository;
        $this->userRepository = $userRepository;
    }
    public function execute()
    {
        $transaction = new Transaction();
        $transaction->setStatus('CONVERSION');
        $transaction->setDate(new \DateTime());

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
        $currency = $this->currencyRepository->getByCurrencyCode($code);
        if(!$currency) {
            throw new \Exception("Moeda não disponivel para conversão.");
        }
        $transaction->setDataToConvert($currency);
        $paymentType = $this->paymentRepository->getById((int)$paymentId);
        if(!$paymentType) {
            throw new \Exception("Tipo de pagamento Invalido.");
        }
        $transaction->setPayment($paymentType);
        $transaction->setValue((float)$value);
        $transaction = $this->transactionRepository->save($transaction);
        $resultData = $transaction->convertValue();
        return $resultData;
    }
  
}
