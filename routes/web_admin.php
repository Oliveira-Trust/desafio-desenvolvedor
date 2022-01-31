<?php
Route::middleware(['web_admin'])
    ->get('/home', 'HomeController@index')->name('home');

Route::middleware(['web_admin', 'auth:web_admin'])
    ->post('exchange/purchase/store-setup', 'ExchangePurchaseSetupController@store')->name('exchange-purchase-store-setup');





// autenticcação
Route::get('login', 'Auth\\LoginController@showLoginForm')->name('login-form');
Route::post('login', 'Auth\\LoginController@login')->name('login');
Route::middleware(['web_admin', 'auth'])
    ->post('logout', 'Auth\\LoginController@logout')->name('logout');
//Route::post('password/email', function () {
//    return abort(404);
//})->name('password-email');
//Route::get('password/reset', function () {
//    return abort(404);
//})->name('password-reset-form');
//Route::post('password/reset', function () {
//    return abort(404);
//})->name('password-reset');
//
//Route::middleware(['auth:web_admin'])->get('register', function () {
//    return abort(404);
//})->name('password-register-form');
//Route::middleware(['auth:web_admin'])->post('register', function () {
//    return abort(404);
//})->name('password-register');



