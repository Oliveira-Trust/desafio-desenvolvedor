<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home-page', function () {
    return view('home-page');
});

Route::get('/', function () {
    return view('login-page');
});

Route::get('/login', function () {
    return view('login-page');
});
