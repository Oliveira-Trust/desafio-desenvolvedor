<?php

declare(strict_types=1);

namespace App\Test\Repositories;


use App\Helpers\EntityManagerFactory;
use App\Domain\Repositories\Memory\UserRepositoryMemory;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    protected $emMock;
    protected $userRepository;

    public function setUp():void
    {
        $this->emMock = $this->createMock(EntityManagerFactory::class);
        $this->userRepository = new UserRepositoryMemory($this->emMock);
    }
    public function testShoudReturnAnArrayWithUsers()
    {
        $users = $this->userRepository->getAll();
        $this->assertIsArray($users);
    }
}