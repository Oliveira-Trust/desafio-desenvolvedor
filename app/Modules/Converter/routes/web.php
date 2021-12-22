<?php

$router = $this->app->router;

$router->group([
    'namespace' => 'Converter\Http\Controllers',
    'prefix' => 'api/converter'
], function () use ($router) {
    $router->get('/', 'ConverterController@getCurrencies');
    $router->post('/', 'ConverterController@payment');
});