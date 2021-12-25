<?php

declare(strict_types=1);

namespace App\Domain\Contracts;

use App\Domain\Entities\User;
use App\Helpers\EntityManagerFactory;

interface UserRepositoryInterface
{
    public function __construct(EntityManagerFactory $entityManagerFactory);
    public function getById(int $id):? User;
    public function delete(User $user):void;
    public function getAll(): array;
    public function getByUsername(string $username):? User;

    public function save(User $user): User;
}
