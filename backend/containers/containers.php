<?php

use App\Helpers\EntityManagerFactory;
use App\Domain\Repositories\UserRepository;
use App\Service\Jwt\Jwt;

$container  = $app->getContainer();

$container['UserRepository'] = function () {
     return new UserRepository(new EntityManagerFactory());
};
$container['auth'] = function () use ($config) {
     return new Jwt(env('SECRET_KEY_TOKEN'));
};