<?php
declare(strict_types=1);

namespace App\Domain\UseCases\User;

use App\Domain\Contracts\Repository\UserRepositoryInterface;

class GetAllUser
{
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
         $this->repository = $repository;
    }
    public function execute()
    {
        $users = $this->repository->getAll();
        if(empty($users)){
            throw new \Exception("No registered users.");
        }
        return $users;
    }
}