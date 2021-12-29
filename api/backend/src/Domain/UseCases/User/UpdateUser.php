<?php

declare(strict_types=1);

namespace App\Domain\UseCases\User;

use App\Domain\Contracts\Helpers\ValidateInterface;
use App\Domain\Contracts\Repository\UserRepositoryInterface;

class UpdateUser
{
    private $dataId;
    private $dataUser;
    private $validator;
    private $repository;

    public function __construct(int $id, array $data, ValidateInterface $validator,UserRepositoryInterface $repository)
    {
        $this->dataId = $id;
        $this->dataUser = $data;
        $this->validator = $validator;
        $this->repository = $repository;        
    }
    public function execute()
    {
        $user = $this->repository->getById($this->dataId);
        if(!$user){
            throw new \Exception("Usuario não encontrado para atualizar.");
        }
        $data = $this->validator->unsetEmptyData($this->dataUser);
        $isEmpty = $this->validator->isEmptyArray($data);
        if($isEmpty) {
            throw new \Exception("Usuario sem dados para atualizar.");
        }
        foreach($data as $key => $value){
            if($key === 'id'){
                continue;
            }
            $user->{'set'.ucfirst($key)}($value);
        }
        $this->repository->save($user);
        return $user;
    }

}