<?php

/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-01-17
 */
require __DIR__.'/../app/vendor/autoload.php';

$app = Selene\App\Factory::create('/var/www/html/app/');

/*
|--------------------------------------------------------------------------
| Definição das rotas WEB - NÃO Autenticadas
|--------------------------------------------------------------------------
*/
$app->route()->group('guest', function () use ($app) {
    $app->route()->get('/client/signin', 'SignController@signin');
    $app->route()->get('/client/signup', 'SignController@signup');
    $app->route()->get('/client/forgot/password', 'SignController@forgotPassword');
    $app->route()->post('/client/account/signin', 'UserSignInAccountController@signin');
    $app->route()->post('/client/account/register', 'UserRegisterAccountController@register');
});

/*
|--------------------------------------------------------------------------
| Definição das rotas WEB - Autenticadas
|--------------------------------------------------------------------------
*/
$app->route()->group('auth', function () use ($app) {
    $app->route()->middleware([new Selene\Middleware\Handler\Auth]);
    $app->route()->get('/', 'CurrencyController@index');
    $app->route()->get('/client/convert/history', 'HistoryController@index');
    $app->route()->get('/client/logout', 'UserSignInAccountController@logout');
    $app->route()->get('/admin/config', 'AdminConfigController@index');
});

/*
|--------------------------------------------------------------------------
| Definição das rotas de API
|--------------------------------------------------------------------------
*/
$app->route()->group('api', function () use ($app) {
    $app->route()->post('/currency/convert', 'CurrencyConverterController@convert');
    $app->route()->get('/orders', 'OrdersController@orders');
    $app->route()->get('/payment/types', 'PaymentController@getPaymentMethods');
    $app->route()->get('/currency/codes', 'CurrencyCodesController@codes');
    $app->route()->post('/admin/config/update/taxes', 'AdminConfigController@updateTaxes');
});

$app->route()->run();
