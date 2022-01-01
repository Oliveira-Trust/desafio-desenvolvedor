<?php

declare(strict_types=1);

namespace App\Domain\UseCases\TaxTransactions;

use App\Domain\Contracts\Helpers\ValidateInterface;
use App\Domain\Entities\TaxTransaction;
use App\Domain\Contracts\Repository\TaxTransactionRepositoryInterface;

class EditTaxTransactions
{
    private $data;
    private $validator;
    private $taxTransactionRepository;

    public function __construct(array $data, TaxTransactionRepositoryInterface $taxTransactionRepository, ValidateInterface $validator)
    {
        $this->data = $data;
        $this->validator = $validator;
        $this->taxTransactionRepository = $taxTransactionRepository;
    }
    public function execute(): TaxTransaction
    {
        $taxTransaction = $this->taxTransactionRepository->getTaxTransaction();
        if(!$taxTransaction){
            throw new \Exception("Taxa não encontrado para atualizar.");
        }
        $data = $this->validator->unsetEmptyData($this->data);
        $isEmpty = $this->validator->isEmptyArray($data);
        if($isEmpty) {
            throw new \Exception("Você não enviou dados para atualizar.");
        }
        $taxTransaction->setMinimumTransactionValue($data['minimumTransactionValue']);
        $taxTransaction->setMaximumTransactionValue($data['maximumTransactionValue']);
        $taxTransaction->setRateForlowValue($data['rateForlowValue']);
        $taxTransaction->setLowValue($data['lowValue']);
        $taxTransaction->setRateForHighValue($data['rateForHighValue']);
        $this->taxTransactionRepository->save($taxTransaction);
        return $taxTransaction;
    }  
}
