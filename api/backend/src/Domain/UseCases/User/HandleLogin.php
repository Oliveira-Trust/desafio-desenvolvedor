<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User;

use App\Domain\Contracts\Repository\UserRepositoryInterface;

class HandleLogin
{
    public function __construct(array $data, UserRepositoryInterface $repository)
    {
        $this->dataLogin = $data;
        $this->repository = $repository;
    }
    public function execute()
    {
        $username = $this->dataLogin['username'];
        $user = $this->repository->getByUsername($username);
        if(!$user){
            $user = $this->repository->getByEmail($username);
        }
        if(!$user){
            throw new \Exception("Usuario e/ou senha invalidos.");
        }
        $password = $this->dataLogin['password'];
        $isValidPassword = $user->validatePassword($password, $user->getPassword());

        if(!$isValidPassword){
            throw new \Exception("Usuario e/ou senha invalidos.");
        }
        return $user;
    }
}