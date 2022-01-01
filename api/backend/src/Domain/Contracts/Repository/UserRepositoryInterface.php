<?php

declare(strict_types=1);

namespace App\Domain\Contracts\Repository;

use App\Domain\Entities\User;
use App\Helpers\EntityManagerFactory;

interface UserRepositoryInterface
{
    public function getById(int $id):? User;
    public function delete(User $user):void;
    public function getAll(): array;
    public function getByUsername(string $username):? User;
    public function getByEmail(string $email):? User;
    public function save(User $user): User;
}
