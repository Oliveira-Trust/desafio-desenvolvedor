<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyConversionController;
use App\Http\Controllers\HealthCheckController;

Route::get('/', function () {
    return view('welcome');
});

// Rota para exibir o formulário de conversão
Route::get('/currency-conversion', [CurrencyConversionController::class, 'index'])->name('currency.index');

// Rota para processar o formulário de conversão (método POST)
Route::post('/currency-conversion', [CurrencyConversionController::class, 'convert'])->name('currency.convert');

// Rota de exibição da página de login
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');

// Rota de processamento do formulário de login
Route::post('/login', 'Auth\LoginController@login');

// Rota de exibição da página de registro
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');

// Rota de processamento do formulário de registro
Route::post('/register', 'Auth\RegisterController@register');

Route::middleware('auth')->get('/quotations', 'QuotationController@index');

// Rota para exibição do painel após o login (rota protegida por autenticação)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rota para o health check (acessível por todos, não requer autenticação)
Route::get('/health', [HealthCheckController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
