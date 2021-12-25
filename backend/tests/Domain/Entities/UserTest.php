<?php

declare(strict_types=1);

namespace App\Test\Entities;

use App\Domain\Entities\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
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
    public function testShouldReturnAnArrayWhenCalledMethodToArrayOfUser()
    {
        $user = new User();
        $user->setName($this->dataUser['name'])
            ->setUsername($this->dataUser['username'])
            ->setPassword($this->dataUser['password']);

        $this->assertArrayHasKey('username', $user->toArray());
        $this->assertArrayHasKey('name', $user->toArray());
        $this->assertIsArray($user->toArray());
        $this->assertArrayNotHasKey('password', $user->toArray());
    }
    public function testShouldReturnAnInstanceOfUser()
    {
        $user = new User();
        $user->setName($this->dataUser['name'])
            ->setUsername($this->dataUser['username'])
            ->setPassword($this->dataUser['password']);
        $this->assertInstanceOf(User::class, $user);
    }
    public function testShouldTestMethodsGettersOfUser()
    {
        $user = new User();
        $user->setName($this->dataUser['name'])
            ->setUsername($this->dataUser['username'])
            ->setPassword($this->dataUser['password']);
        $this->assertEquals('Tester', $user->getName());
        $this->assertEquals($this->dataUser['username'], $user->getUsername());
        $this->assertTrue($user->validatePassword($this->dataUser['password'], $user->getPassword()));
    }
}