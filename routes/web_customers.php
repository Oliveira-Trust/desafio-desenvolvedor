<?php
Route::middleware(['web_customers', 'auth:web_customers'])
    ->get('/home', 'Customers\HomeController@exchangeRate')->name('home');
Route::middleware(['web_customers', 'auth:web_customers'])
    ->get('/cotacoes', 'Customers\HomeController@index')->name('exchange-rete-list');
Route::middleware(['web_customers', 'auth:web_customers'])
    ->post('exchanges/calculate-purchase', 'Customers\ExchangesController@calculatePurchase')
    ->name('exchanges.calculate-purchase');
//customer.login
Route::post('login', 'Customers\Auth\LoginController@login')
    ->name('login');

//customer.logout
Route::middleware(['web_customers', 'auth:web_customers'])
->post('logout', 'Customers\Auth\LoginController@logout')
    ->name('logout');
Route::get('login', 'Customers\Auth\LoginController@showLoginForm')
    ->name('login-form');

Route::post('auth/password/email', function () {
    return abort(404);
})->name('password-email');
Route::get('password/reset', function () {
    return abort(404);
})->name('password-reset-form');
Route::post('password/reset', function () {
    return abort(404);
})->name('password-reset');

Route::get('auth/register', function () {
    return abort(404);
})->name('password-register-form');
Route::post('auth/register', function () {
    return abort(404);
})->name('password-register');


