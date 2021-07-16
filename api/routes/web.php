<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'] , function () use ($router) {

    $router->group(['namespace' => 'User'], function () use ($router) {

        $router->post('register', 'AuthController@register');
        $router->post('login', 'AuthController@login');

        $router->group(['middleware' => 'auth'], function () use ($router) {
            $router->get('me', 'AuthController@me');
        });
    });

    $router->group([
        'prefix' => 'customer',
        'namespace' => 'Customer',
        'middleware' => 'auth'
    ], function () use ($router) {
        $router->get('/', 'CustomerController@index');
        $router->post('/', 'CustomerController@store');
        $router->get('/{id}', 'CustomerController@show');
        $router->put('/{id}', 'CustomerController@update');
        $router->delete('/{id}', 'CustomerController@delete');
    });

    $router->group([
        'prefix' => 'product',
        'namespace' => 'Product',
        'middleware' => 'auth'
    ], function () use ($router) {
        $router->get('/', 'ProductController@index');
        $router->post('/', 'ProductController@store');
        $router->get('/{id}', 'ProductController@show');
        $router->put('/{id}', 'ProductController@update');
        $router->delete('/{id}', 'ProductController@delete');
    });

    $router->group([
        'prefix' => 'category',
        'namespace' => 'Product',
        'middleware' => 'auth'
    ], function () use ($router) {
        $router->get('/', 'CategoryController@index');
        $router->post('/', 'CategoryController@store');
        $router->get('/{id}', 'CategoryController@show');
        $router->put('/{id}', 'CategoryController@update');
        $router->delete('/{id}', 'CategoryController@delete');
    });

});
