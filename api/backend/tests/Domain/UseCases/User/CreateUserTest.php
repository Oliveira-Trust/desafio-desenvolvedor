<?php

declare(strict_types=1);

namespace App\Test\Domain\UseCases\User;

use App\Domain\Entities\User;
use App\Domain\Repositories\Memory\UserRepositoryMemory;
use App\Domain\UseCases\User\CreateUser;
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
    public function testMustthrowAnExceptionWhenAllFieldsIsEmpty()
    {
        try{
            $entityManager = new EntityManagerFactory();
            $createUser = new CreateUser([], new UserRepositoryMemory($entityManager));
            $user = $createUser->execute();
        }catch(\Exception $e){
            $this->assertEquals($e->getMessage(), "It is not possible to create a user without data");
        }
    }
    public function testMustthrowAnExceptionWhenAnyFieldIsEmpty()
    {
        try{
            $this->dataUser['password'] = '';
            $entityManager = new EntityManagerFactory();
            $createUser = new CreateUser($this->dataUser, new UserRepositoryMemory($entityManager));
            $createUser->execute();
        }catch(\Exception $e){
            $this->assertEquals($e->getMessage(), "Field password is Empty.");
        }
    }
    public function testMustThrowAnExceptionWhenUserAlreadyExists()
    {
        try{
            $entityManager = new EntityManagerFactory();
            $createUser = new CreateUser($this->dataUser, new UserRepositoryMemory($entityManager));
            $createUser->execute();
            $createUser->execute();
        }catch(\Exception $e){
            $this->assertEquals($e->getMessage(), "User already registered.");
        }
    }
}