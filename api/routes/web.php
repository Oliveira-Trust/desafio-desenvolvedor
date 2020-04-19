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

    // $router->get('users', function () {
    //     // Matches The "/admin/users" URL
    // });

    $router->post('/register', 'AuthController@authenticate');
    $router->post('/login', 'AuthController@login');
    // $router->post('/usuario/{id}', 'AuthController@login');

    $router->get('/clientes', 'ClienteController@index');
    $router->get('/clientes/{id}', 'ClienteController@show');
    $router->post('/clientes', 'ClienteController@store');
    $router->put('/clientes/{id}', 'ClienteController@update');
    $router->delete('/clientes/{id}', 'ClienteController@destroy');

    $router->get('/produtos', 'ProdutoController@index');
    $router->get('/produtos/{id}', 'ProdutoController@show');
    $router->post('/produtos', 'ProdutoController@store');
    $router->put('/produtos/{id}', 'ProdutoController@update');
    $router->delete('/produtos/{id}', 'ProdutoController@destroy');

    $router->get('/pedidos', 'PedidoController@index');
    $router->get('/pedidos/{id}', 'PedidoController@show');
    $router->post('/pedidos', 'PedidoController@store');
    $router->put('/pedidos/{id}', 'PedidoController@update');
    $router->delete('/pedidos/{id}', 'PedidoController@destroy');

    $router->get('/statuses', 'StatusController@index');
});
