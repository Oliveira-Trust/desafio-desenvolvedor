<?php

declare(strict_types=1);

namespace App\Test\Repositories;

use App\Entities\User;
use App\Helpers\EntityManagerFactory;
use App\Repositories\UserRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    protected $emMock;
    protected $queryMock;
    protected $userRepository;
    protected $entityManager;

    public function setUp():void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->emMock = $this->createMock(EntityManagerFactory::class);
        $this->queryMock = $this->createStub(AbstractQuery::class);
        $this->emMock->method('getEntityManager')->willReturn($this->entityManager);
        $this->userRepository = new UserRepository($this->emMock);
    }
    public function testShouldCallMethodCreateQueryOfEntityManager()
    {
        $this->queryMock->method('setParameter');
        $this->queryMock->method('getResult');
        $this->entityManager->expects($this->once())->method('createQuery')->willReturn($this->queryMock);
        $this->userRepository->getById(10);
    }
    public function testShouldCallMethodRemoveOfEntityManager()
    {
        $userMock = $this->createStub(User::class);
        $this->entityManager->expects($this->once())->method('remove');
        $this->entityManager->expects($this->once())->method('flush');
        $this->userRepository->delete($userMock);
    }
    public function testShoudReturnAnArrayWithUsers()
    {
        $userMock = $this->createStub(User::class);
        $this->queryMock->expects($this->once())->method('getResult')->willReturn([$userMock, $userMock]);
        $this->entityManager->method('createQuery')->willReturn($this->queryMock);
        $this->userRepository->getAll();
    }
    public function testShouldReturnAnUserByUsername()
    {
        $userMock = $this->createStub(User::class);        
        $this->queryMock->expects($this->once())->method('getResult')->willReturn([$userMock]);
        $this->entityManager->method('createQuery')->willReturn($this->queryMock);
        $this->assertEquals($userMock, $this->userRepository->getByUsername('tester'));
    }
    public function testShouldCallMethodPersistOfEntityManager()
    {
        $userMock = $this->createStub(User::class);
        
        $this->entityManager->expects($this->once())->method('persist');

        $this->entityManager->expects($this->once())->method('flush');
        
        $this->userRepository->save($userMock);
    }
}