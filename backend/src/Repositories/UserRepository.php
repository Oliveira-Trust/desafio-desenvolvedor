<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\User;
use App\Helpers\EntityManagerFactory;

class UserRepository extends \Doctrine\ORM\EntityRepository
{
    protected $entityManager;
    public function __construct(EntityManagerFactory $entityManagerFactory)
    {
        $this->entityManager = $entityManagerFactory->getEntityManager();
    }
    public function getById(int $id)
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Entities\User u WHERE u.id = :paramid');
        $query->setParameter('paramid', $id);
        return $query->getResult()[0] ?? false;
    }
    public function delete(User $user):void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
    public function getAll(): array
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Entities\User u');
        $results = $query->getResult();
        $response = [];
        foreach ($results as $user) {
            array_push($response, $user->toArray());
        }
        return $response;
    }
    public function getByUsername(string $username)
    {
        $query = $this->entityManager->createQuery('SELECT u FROM App\Entities\User u WHERE u.username = :username');
        $query->setParameter('username', $username);
        return $query->getResult()[0] ?? false;
    }
    public function save(User $user): User
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
        return $user;
    }
}
