<?php

declare(strict_types=1);

namespace App\Domain\Repositories;

use App\Domain\Contracts\UserRepositoryInterface;
use App\Domain\Entities\User;
use App\Helpers\EntityManagerFactory;

class UserRepositoryDatabase extends \Doctrine\ORM\EntityRepository implements UserRepositoryInterface
{
    protected $entityManager;
    public function __construct(EntityManagerFactory $entityManagerFactory)
    {
        $this->entityManager = $entityManagerFactory->getEntityManager();
    }
    public function getById(int $id):? User
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\User u WHERE u.id = :paramid');
        $query->setParameter('paramid', $id);
        return $query->getResult()[0] ?? null;
    }
    public function delete(User $user):void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
    public function getAll(): array
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\User u');
        $results = $query->getResult();
        $response = [];
        foreach ($results as $user) {
            array_push($response, $user->toArray());
        }
        return $response;
    }
    public function getByUsername(string $username):? User
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Domain\Entities\User u WHERE u.username = :username');
        $query->setParameter('username', $username);
        return $query->getResult()[0] ?? null;
    }
    public function save(User $user): User
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }
}
