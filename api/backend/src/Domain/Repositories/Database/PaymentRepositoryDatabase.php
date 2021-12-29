<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Database;

use App\Domain\Contracts\Repository\PaymentRepositoryInterface;
use App\Domain\Entities\Payment;
use App\Helpers\EntityManagerFactory;
use Doctrine\ORM\EntityManager;

class PaymentRepositoryDatabase implements PaymentRepositoryInterface
{
    protected $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function getById(int $id):? Payment
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Payment u WHERE u.id = :paramid');
        $query->setParameter('paramid', $id);
        $result = $query->getOneOrNullResult();
        return $result;
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
    public function getByType(string $type):? Payment
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\Payment u WHERE u.type = :type');
        $query->setParameter('type', $type);
        return $query->getOneOrNullResult();
    }
    public function save(Payment $payment): Payment
    {
        $this->entityManager->persist($payment);
        $this->entityManager->flush();
        return $payment;
    }
}