<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(
    ['prefix' => 'api'],
    function () use ($router): void {
        $router->post('register', 'AuthController@registerAction');
        $router->post('login', 'AuthController@loginAction');

        Route::group(
            ['middleware' => 'auth:api'],
            function (): void {
                Route::post('register/conversion', 'CurrencyConversionController@registerConversionAction');
                Route::get('register/conversion', 'CurrencyConversionController@historicConversionAction');
                Route::get('send/email', 'SendEmailController@registerConversionAction');
            }
        );
    }
);
