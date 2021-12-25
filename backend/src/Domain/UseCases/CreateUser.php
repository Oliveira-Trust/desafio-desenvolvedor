<?php

declare(strict_types=1);

namespace App\Domain\UseCases;

use App\Domain\Entities\User;
use App\Helpers\EntityManagerFactory;
use Exception;

class CreateUser
{
    private array $dataUser;

    public function __construct(array $data, EntityManagerFactory $entityFactor)
    {
        $this->dataUser = $data;
        $this->entityManager = $entityFactor->getEntityManager();
    }
    public function execute(): ?User
    {
        $user = new User;
        foreach($this->dataUser as $key => $value) {
            if(!$value) {
                throw new Exception("Field {$key} is Empty.");
            }
            $user->{'set'.ucfirst($key)}($value);
        }
        return $user;
    }
}