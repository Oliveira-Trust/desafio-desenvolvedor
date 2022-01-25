<?php

use Illuminate\Support\Facades\Route;

// AUTH
Auth::routes();
Route::get('/', 'HomeController@index')
    ->name('home')
    ->middleware('auth');
Route::post('/login', 'UserController@auth')->name('auth.user');
Route::get('/login', 'LoginController@login')->name('login.page');
Route::get('/logout', 'LoginController@logout')->name('logout.page');

// API
Route::post('/conversao', 'ConversaoController@converter')
    ->name('conversao')
    ->middleware('auth');
