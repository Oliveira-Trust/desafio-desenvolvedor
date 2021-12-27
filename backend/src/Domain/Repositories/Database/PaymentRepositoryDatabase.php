<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Database;

use App\Domain\Contracts\Repository\PaymentRepositoryInterface;
use App\Domain\Entities\Payment;
use App\Helpers\EntityManagerFactory;

class PaymentRepositoryDatabase implements PaymentRepositoryInterface
{
    protected $entityManager;
    public function __construct(EntityManagerFactory $entityManagerFactory)
    {
        $this->entityManager = $entityManagerFactory->getEntityManager();
    }
    public function getById(int $id):? Payment
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Payment u WHERE u.id = :paramid');
        $query->setParameter('paramid', $id);
        return $query->getOneOrNullResult();
    }
    public function delete(Payment $payment):void
    {
        $this->entityManager->remove($payment);
        $this->entityManager->flush();
    }
    public function getAll(): array
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Payment u');
        $results = $query->getResult();
        $response = [];
        foreach ($results as $payment) {
            $response[] = $payment->toArray();
        }
        return $response;
    }
    public function getByName(string $name):? Payment
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Payment u WHERE u.name = :name');
        $query->setParameter('name', $name);
        return $query->getOneOrNullResult();
    }
    public function save(Payment $payment): Payment
    {
        $this->entityManager->persist($payment);
        $this->entityManager->flush();
        return $payment;
    }
}