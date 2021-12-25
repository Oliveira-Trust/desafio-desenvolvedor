<?php

declare(strict_types=1);

namespace App\Test\Entities;

use App\Domain\Entities\User;
use App\Domain\Repositories\UserRepositoryDatabase;
use App\Domain\Repositories\UserRepositoryMemory;
use App\Domain\UseCases\CreateUser;
use App\Helpers\EntityManagerFactory;
use PHPUnit\Framework\TestCase;

class CreateUserTest extends TestCase
{
    protected $dataUser;

    public function setUp(): void
    {
        $this->dataUser = [
            "name"=> "Tester",
            "username"=>"Tester01",
            "password"=>"123456",
            "email"=>"teste@teste.com.br"
        ];
    }
    public function testMustCreateAUser()
    {
        $entityManager = new EntityManagerFactory();
        $createUser = new CreateUser($this->dataUser, new UserRepositoryMemory($entityManager));
        $user = $createUser->execute();
        $this->assertInstanceOf(User::class, $user);
    }
    public function testMustthrowAnExceptionWhenAnyFieldIsEmpty()
    {
        try{
            $this->dataUser['password'] = '';
            $entityManager = new EntityManagerFactory();
            $createUser = new CreateUser($this->dataUser, new UserRepositoryMemory($entityManager));
            $user = $createUser->execute();
        }catch(\Exception $e){
            $this->assertEquals($e->getMessage(), "Field password is Empty.");
        }
    }
}