<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire;

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

Route::get('/', fn () => redirect()->route('auth.login.index'));

Route::middleware('guest')->group(function () {
    Route::get('acesso', [Auth\LoginController::class, 'index'])->name('auth.login.index');
    Route::post('acesso', [Auth\LoginController::class, 'handle'])->name('auth.login.handle');

    Route::get('cadastro', [Auth\RegistrationController::class, 'index'])->name('auth.registration.index');
    Route::post('cadastro', [Auth\RegistrationController::class, 'handle'])->name('auth.registration.handle');

    Route::get('redefinir-senha', [Auth\ForgotPasswordController::class, 'index'])->name('auth.forgot-password.index');
    Route::post('redefinir-senha', [Auth\ForgotPasswordController::class, 'handle'])->name('auth.forgot-password.handle');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::get('cotacoes', Livewire\Quotations\Index::class)->name('quotations.index');
    Route::get('cotacoes/editar/{id}', Livewire\Quotations\Edit::class)->middleware('isAdmin')->name('quotations.edit');
    Route::get('cotacoes/adicionar', Livewire\Quotations\Create::class)->name('quotations.create');
    
    Route::get('moedas', Livewire\Currencies\Index::class)->middleware('isAdmin')->name('currencies.index');
    Route::get('moedas/editar/{id}', Livewire\Currencies\Edit::class)->middleware('isAdmin')->name('currencies.edit');
    Route::get('moedas/adicionar', Livewire\Currencies\Create::class)->middleware('isAdmin')->name('currencies.create');

    Route::get('sair', [Auth\LoginController::class, 'logout'])->name('auth.logout');
});
