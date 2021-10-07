<?php

/** @var \Laravel\Lumen\Routing\Router $router */

//Rota de Registro e Authenticacao

$router->group(['prefix'=>'auth'], function () use ($router) {
    $router->post('register',['uses'=>'UsuariosController@register']);
    $router->post('login', ['uses'=>'Auth\AuthController@login']);
    $router->post('logout',['uses'=>'Auth\AuthController@logout']);
    $router->post('token',['uses'=>'Auth\AuthController@validate']);
});

//Rota do Crud de Moedas, Taxas e Conversor
$router->group(['prefix'=>'moedas'], function () use ($router) {
    $router->get('listar',['uses'=>'MoedasController@show']);
    $router->get('listar/{id}',['uses'=>'MoedasController@show']);
    $router->post('nova',['uses'=>'MoedasController@create']);
    $router->put('editar/{id}',['uses'=>'MoedasController@update']);
    $router->delete('deletar/{id}',['uses'=>'MoedasController@delete']);
    $router->post('converter',['uses'=>'MoedasController@converter']);
});

//Rota CRUD de Historico
$router->group(['prefix'=>'historico'], function () use ($router) {
    $router->get('listar',['uses'=>'HistoricoController@show']);
    $router->get('listar/{id}',['uses'=>'HistoricoController@show']);
    $router->post('novo',['uses'=>'HistoricoController@create']);
    $router->put('editar/{id}',['uses'=>'HistoricoController@update']);
    $router->delete('deletar/{id}',['uses'=>'HistoricoController@delete']);
});

//Rota CRUD de Usuarios
$router->group(['prefix'=>'usuarios'], function () use ($router) {
    $router->get('listar',['uses'=>'UsuariosController@show']);
    $router->get('listar/{id}',['uses'=>'UsuariosController@show']);
    $router->post('novo',['uses'=>'UsuariosController@create']);
    $router->put('editar/{id}',['uses'=>'UsuariosController@update']);
    $router->delete('deletar/{id}',['uses'=>'UsuariosController@delete']);
});
