<?php

$router = $this->app->router;

$router->group([
    'prefix' => 'api/auth',
    'namespace' => 'Auth\Http\Controllers'
], function ($router) {
    $router->post('login', 'AuthController@login');
    $router->post('logout', 'AuthController@logout');
    $router->post('me', 'AuthController@me');
});