<?php

declare(strict_types=1);

namespace App\Test\Entities;

use App\Domain\Entities\User;
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
            "password"=>"123456"
        ];
    }
    public function testMustCreateAUser()
    {
        $createUser = new CreateUser($this->dataUser, new EntityManagerFactory);
        $user = $createUser->execute();
        $this->assertInstanceOf(User::class, $user);
    }
    public function testMustthrowAnExceptionWhenAnyFieldIsEmpty()
    {
        try{
            $this->dataUser['password'] = '';
            $createUser = new CreateUser($this->dataUser, new EntityManagerFactory);
            $user = $createUser->execute();
        }catch(\Exception $e){
            $this->assertEquals($e->getMessage(), "Field password is Empty.");
        }
    }
}