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

// REGISTRO
Route::get('/registro', 'UserController@registroPage')->name('registro.page');
Route::post('/registrar', 'UserController@registrarUsuario')->name('registro.user');

// API
Route::post('/conversao', 'ConversaoController@converter')
    ->name('conversao')
    ->middleware('auth');
