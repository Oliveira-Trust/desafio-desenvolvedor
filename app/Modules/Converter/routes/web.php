<?php

$router = $this->app->router;

$router->group([
    'namespace' => 'Converter\Http\Controllers',
    'prefix' => 'api/converter',
    'middleware' => 'auth'
], function () use ($router) {
    $router->get('/get-currencies', 'ConverterController@getCurrencies');
    $router->get('/', 'ConverterController@index');
    $router->post('/', 'ConverterController@payment');
});