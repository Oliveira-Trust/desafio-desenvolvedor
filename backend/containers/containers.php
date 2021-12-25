<?php

use App\Helpers\EntityManagerFactory;
use App\Domain\Repositories\UserRepositoryDatabase;
use App\Service\Jwt\Jwt;

$container  = $app->getContainer();

$container['UserRepository'] = function () {
     return new UserRepositoryDatabase(new EntityManagerFactory());
};
$container['auth'] = function () use ($config) {
     return new Jwt(env('SECRET_KEY_TOKEN'));
};