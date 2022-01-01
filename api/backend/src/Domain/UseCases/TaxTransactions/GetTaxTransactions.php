<?php
declare(strict_types=1);

namespace App\Domain\UseCases\TaxTransactions;

use App\Domain\Entities\TaxTransaction;
use App\Domain\Contracts\Repository\TaxTransactionRepositoryInterface;

class GetTaxTransactions
{
    private $taxTransactionRepository;

    public function __construct(TaxTransactionRepositoryInterface $taxTransactionRepository)
    {
        $this->taxTransactionRepository = $taxTransactionRepository;
    }
    public function execute(): TaxTransaction
    {
        $taxTransaction = $this->taxTransactionRepository->getTaxTransaction();
        if(!$taxTransaction){
            throw new \Exception("Nenhuma Taxa foi encontrado.");
        }
        return $taxTransaction;
    }  
}
