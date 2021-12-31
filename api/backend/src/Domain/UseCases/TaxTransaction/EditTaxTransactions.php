<?php

declare(strict_types=1);

namespace App\Domain\UseCases\TaxTransactions;

use App\Domain\Contracts\Helpers\ValidateInterface;
use App\Domain\Entities\TaxTransaction;
use App\Domain\Contracts\Repository\TaxTransactionRepositoryInterface;

class CreateConversion
{
    private $data;
    private $taxTransactionRepository;

    public function __construct(array $data, TaxTransactionRepositoryInterface $taxTransactionRepository, ValidateInterface $validator)
    {
        $this->data = $data;
        $this->taxTransactionRepository = $taxTransactionRepository;
    }
    public function execute(): TaxTransaction
    {
        $taxTransaction = $this->taxTransactionRepository->getById($this->dataId);
        if(!$taxTransaction){
            throw new \Exception("Taxa não encontrado para atualizar.");
        }
        $data = $this->validator->unsetEmptyData($this->data);
        $isEmpty = $this->validator->isEmptyArray($data);
        if($isEmpty) {
            throw new \Exception("Você não enviou dados para atualizar.");
        }
        foreach($data as $key => $value){
            if($key === 'id'){
                continue;
            }
            $taxTransaction->{'set'.ucfirst($key)}($value);
        }
        $this->repository->save($taxTransaction);
        return $taxTransaction;
    }  
}
