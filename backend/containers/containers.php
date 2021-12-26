<?php

use App\Helpers\EntityManagerFactory;
use App\Domain\Repositories\Database\UserRepositoryDatabase;
use App\Helpers\HttpRequest;
use App\Service\Jwt\Jwt;

$container  = $app->getContainer();

$container['UserRepository'] = function () {
     return new UserRepositoryDatabase(new EntityManagerFactory());
};
$container['auth'] = function () use ($config) {
     return new Jwt(env('SECRET_KEY_TOKEN'));
};

$container['http'] = function() {
     return new HttpRequest(['url'=> env('API_ECONOMIA')]);
};