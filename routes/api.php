<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);


$api->version('v1', function (Router $api) {
    $api->group(['middleware' => ['cors'], 'prefix' => 'auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');

        $api->post('logout', 'App\\Api\\V1\\Controllers\\LogoutController@logout');
        $api->post('refresh', 'App\\Api\\V1\\Controllers\\RefreshController@refresh');
        $api->get('me', 'App\\Api\\V1\\Controllers\\UserController@me');
    });

    $api->group(['middleware' => ['jwt.auth', 'cors']], function(Router $api) {
        $api->get('protected', function() {
            return response()->json([
                'message' => 'Acesso a recursos protegidos concedidos! Você está vendo este texto enquanto forneceu o token corretamente.'
            ]);
        });

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {
                return response()->json([
                    'message' => 'Ao acessar esse endpoint, você pode atualizar seu token de acesso a cada solicitação. Confira esses cabeçalhos de resposta!'
                ]);
            }
        ]);

        $api->post('salvarPedido', 'App\\Api\\V1\\Controllers\\ApiController@salvarPedido');
        $api->post('salvarCliente', 'App\\Api\\V1\\Controllers\\ApiController@salvarCliente');
        $api->post('salvarProduto', 'App\\Api\\V1\\Controllers\\ApiController@salvarProduto');

        $api->get('obterTodosPedidos', 'App\\Api\\V1\\Controllers\\ApiController@obterTodosPedidos');
        $api->get('obterTodosClientes', 'App\\Api\\V1\\Controllers\\ApiController@obterTodosPedidos');
        $api->get('obterTodosProdutos', 'App\\Api\\V1\\Controllers\\ApiController@obterTodosPedidos');
    });
});