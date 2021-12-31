<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Database;

use App\Domain\Contracts\Repository\TaxTransactionRepositoryInterface;
use App\Domain\Entities\TaxTransaction;
use App\Helpers\EntityManagerFactory;
use Doctrine\ORM\EntityManager;

class TaxTransactionRepositoryDatabase implements TaxTransactionRepositoryInterface
{
    protected $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function getById(int $id):? TaxTransaction
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\TaxTransaction u WHERE u.id = :paramid');
        $query->setParameter('paramid', $id);
        return $query->getOneOrNullResult();
    }
    public function save(TaxTransaction $taxTransaction): TaxTransaction
    {
        $this->entityManager->persist($taxTransaction);
        $this->entityManager->flush();
        return $taxTransaction;
    }
}