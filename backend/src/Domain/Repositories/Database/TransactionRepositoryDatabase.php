<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Database;

use App\Domain\Contracts\Repository\TransactionRepositoryInterface;
use App\Domain\Entities\Transaction;
use App\Helpers\EntityManagerFactory;
use Doctrine\ORM\EntityManager;

class TransactionRepositoryDatabase implements TransactionRepositoryInterface
{
    protected $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function getById(int $id):? Transaction
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Transaction u WHERE u.id = :paramid');
        $query->setParameter('paramid', $id);
        return $query->getOneOrNullResult();
    }
    public function getAll(): array
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Transaction u');
        $results = $query->getResult();
        $response = [];
        foreach ($results as $transaction) {
            $response[] = $transaction->toArray();
        }
        return $response;
    }
    public function getByStatus(string $status):? Transaction
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Transaction u WHERE u.status = :status');
        $query->setParameter('status', $status);
        return $query->getOneOrNullResult();
    }
    public function getByUser(int $id): array
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Transaction u WHERE u.user = :userId');
        $query->setParameter('userId', $id);
        return $query->getResult();
    }
    public function save(Transaction $transaction): Transaction
    {
        $this->entityManager->persist($transaction);
        $this->entityManager->flush();
        return $transaction;
    }
}