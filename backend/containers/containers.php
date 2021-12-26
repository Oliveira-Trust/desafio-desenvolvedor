<?php

use App\Domain\Repositories\Database\CurrencyRepositoryDatabase;
use App\Helpers\EntityManagerFactory;
use App\Domain\Repositories\Database\UserRepositoryDatabase;
use App\Domain\Repositories\Memory\PaymentRepositoryMemory;
use App\Helpers\HttpRequest;
use App\Service\Jwt\Jwt;

$container  = $app->getContainer();
$entityManager = new EntityManagerFactory();
$container['UserRepository'] = function () use ($entityManager){
     return new UserRepositoryDatabase($entityManager);
};
$container['CurrencyRepository'] = function () use ($entityManager){
     return new CurrencyRepositoryDatabase($entityManager);
};
$container['TransactionRepository'] = function () use ($entityManager){
     return new TransactionRepositoryDataba($entityManager);
};
$container['PaymentRepository'] = function () use ($entityManager){
     return new PaymentRepositoryMemory($entityManager);
};
$container['auth'] = function () use ($config) {
     return new Jwt(env('SECRET_KEY_TOKEN'));
};

$container['http'] = function() {
     return new HttpRequest(['url'=> env('API_ECONOMIA_ALL')]);
};
