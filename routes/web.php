<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/cambio/index', [App\Http\Controllers\CambioController::class, 'index'])->name('cambio.index');
    Route::get('cambio/resumo', [App\Http\Controllers\CambioController::class, 'resumo'])->name('cambio.resumo');
    Route::post('/cambio/consultaAPI', [App\Http\Controllers\CambioController::class, 'consultaAPI'])->name('cambio.consultaAPI');
    Route::post('/cambio/enviaEmail', [App\Http\Controllers\CambioController::class, 'enviaEmail'])->name('cambio.enviaEmail');

    Route::get('/logs/index', [App\Http\Controllers\LogsController::class, 'index'])->name('logs.index');
    Route::get('/painel', [App\Http\Controllers\PainelController::class, 'index'])->name('painel.index');
    Route::post('/painel/upsert', [App\Http\Controllers\PainelController::class, 'upsert'])->name('painel.upsert');
});
