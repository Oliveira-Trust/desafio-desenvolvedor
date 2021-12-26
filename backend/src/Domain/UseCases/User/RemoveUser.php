<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User;

use App\Domain\Contracts\Repository\UserRepositoryInterface;
use App\Domain\Entities\User;

class RemoveUser
{
    private $dataId;
    private $repository;

    public function __construct(int $id, UserRepositoryInterface $repository)
    {
        $this->dataId = $id;
        $this->repository = $repository;        
    }
    public function execute()
    {
        $user = $this->repository->getById($this->dataId);
        if(!$user){
            throw new \Exception("Não foi possivel deletar este usuario.");
        }
        $this->repository->delete($user);
        return true;
    }

}