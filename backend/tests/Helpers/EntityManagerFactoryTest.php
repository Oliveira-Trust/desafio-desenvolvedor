<?php

declare(strict_types=1);

namespace App\Test\Helpers;

use App\Helpers\EntityManagerFactory;
use Doctrine\ORM\EntityManager;
use PHPUnit\Framework\TestCase;

class EntityManagerFactoryTest extends TestCase
{

    public function testShouldReturnAnInstanceOfEntityManager()
    {
        $factory = new EntityManagerFactory();
        $entityManager = $factory->getEntityManager();
        $this->assertInstanceOf(EntityManager::class, $entityManager);
    }
}