<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cambio/index', [App\Http\Controllers\CambioController::class, 'index'])->name('cambio.index');
    Route::post('/cambio/consultaAPI', [App\Http\Controllers\CambioController::class, 'consultaAPI'])->name('cambio.consultaAPI');
});
