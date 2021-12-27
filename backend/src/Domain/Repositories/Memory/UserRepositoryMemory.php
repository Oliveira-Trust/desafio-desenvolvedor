<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Memory;

use App\Domain\Contracts\Repository\UserRepositoryInterface;
use App\Domain\Entities\User;
use App\Helpers\EntityManagerFactory;

class UserRepositoryMemory implements UserRepositoryInterface
{
    private $users;
    
    public function __construct()
    {
        $this->users = [];
    }
    public function getById(int $id):? User
    {
        foreach($this->users as $key => $user) {
            if($key === $id) {
                return $user;
            }
        }
        return null;
    }
    
    public function delete(User $user):void
    {
        foreach($this->users as $key => $userData) {
            if($user->getUsername() === $userData->getUsername()) {
                unset($this->users[$key]);
            }
        }
    }

    public function getAll(): array
    {
        return $this->users;
    }
    public function getByUsername(string $username):? User
    {
        foreach($this->users as $key => $user) {
            if($user->getUsername() === $username) {
                return $user;
            }
        }
        return null;
    }
    public function save(User $user): User
    {
        $key = count($this->users) + 1;
        $this->users[$key] = $user;
        return $user;
    }
}
