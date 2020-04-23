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



$router->group(['prefix' => 'api'], function () use ($router) {
    //login
    $router->post('/register', 'AuthController@register');
    $router->post('login', 'AuthController@login');
   
    //User
    $router->group(['prefix'=>'users'],function() use ($router){

        $router->get('/',     'UserController@index');
        $router->get('/{id}', 'UserController@show');
        $router->post('/',    'UserController@store');
        $router->put('/{id}', 'UserController@update');
       
        $router->delete('/{id}', 'UserController@delete');

    });

    //Product
    $router->group(['prefix'=>'products'],function() use ($router){

        $router->get('/',     'ProductController@index');
        $router->get('/{id}', 'ProductController@show');
        $router->post('/',    'ProductController@store');
        $router->put('/{id}', 'ProductController@update');
       
        $router->delete('/{id}', 'ProductController@delete');
        $router->delete('/', 'ProductController@deleteAll');

        $router->get('/pesquise', 'ProductController@search');

    });

    //Request of product
    $router->group(['prefix'=>'request-of-product'],function() use ($router){

        
        $router->get('/products-user', 'RequestProductController@showProductUser');
        $router->get('/users-product/{id}', 'RequestProductController@showUserProduct');
        $router->post('/',    'RequestProductController@store');
        $router->put('/{id}', 'RequestProductController@update');
       
        $router->delete('/{id}', 'RequestProductController@delete');
        
        $router->get('/pesquise', 'RequestProductController@search');
       


    });


    $router->get('profile', 'UserController@profile');
   
 });
