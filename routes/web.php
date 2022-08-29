<?php

use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire;
use App\Mail\QuotationRealizedMail;

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
    Route::get('login', [Auth\LoginController::class, 'index'])->name('auth.login.index');
    Route::post('login', [Auth\LoginController::class, 'handle'])->name('auth.login.handle');

    Route::get('cadastro', [Auth\RegistrationController::class, 'index'])->name('auth.registration.index');
    Route::post('cadastro', [Auth\RegistrationController::class, 'handle'])->name('auth.registration.handle');

    Route::get('esqueceu-a-senha', [Auth\ForgotPasswordController::class, 'index'])->name('auth.forgot-password.index');
    Route::post('esqueceu-a-senha', [Auth\ForgotPasswordController::class, 'handle'])->name('auth.forgot-password.handle');

    Route::get('/redefinir-senha/{token}', [Auth\ForgotPasswordController::class, 'resetPasswordIndex'])->name('password.reset');
    Route::post('/redefinir-senha', [Auth\ForgotPasswordController::class, 'resetPasswordHandle'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', fn() => view('dashboard'))->name('dashboard');

    Route::get('cotacoes', Livewire\Quotations\Index::class)->name('quotations.index');
    Route::get('cotacoes/adicionar', Livewire\Quotations\Create::class)->name('quotations.create');
    
    Route::middleware('isAdmin')->group(function () {
        Route::get('usuarios', Livewire\Users\Index::class)->name('users.index');
        Route::get('usuarios/editar/{id}', Livewire\Users\Edit::class)->name('users.edit');
        Route::get('usuarios/adicionar', Livewire\Users\Create::class)->name('users.create');

        Route::get('formas-de-pagamento', Livewire\PaymentMethod\Index::class)->name('payment-methods.index');
        Route::get('formas-de-pagamento/editar/{id}', Livewire\PaymentMethod\Edit::class)->name('payment-methods.edit');
        Route::get('formas-de-pagamento/adicionar', Livewire\PaymentMethod\Create::class)->name('payment-methods.create');
        
        Route::get('moedas-de-origem', Livewire\SourceCurrencies\Index::class)->name('source-currencies.index');
        Route::get('moedas-de-origem/editar/{id}', Livewire\SourceCurrencies\Edit::class)->name('source-currencies.edit');
        Route::get('moedas-de-origem/adicionar', Livewire\SourceCurrencies\Create::class)->name('source-currencies.create');

        Route::get('moedas-de-destino', Livewire\TargetCurrencies\Index::class)->name('target-currencies.index');
        Route::get('moedas-de-destino/editar/{id}', Livewire\TargetCurrencies\Edit::class)->name('target-currencies.edit');
        Route::get('moedas-de-destino/adicionar', Livewire\TargetCurrencies\Create::class)->name('target-currencies.create');

        Route::get('taxas-de-conversao', Livewire\ConversionFees\Index::class)->name('conversion-fees.index');
        Route::get('taxas-de-conversao/editar/{id}', Livewire\ConversionFees\Edit::class)->name('conversion-fees.edit');
        Route::get('taxas-de-conversao/adicionar', Livewire\ConversionFees\Create::class)->name('conversion-fees.create');
    });

    Route::get('sair', [Auth\LoginController::class, 'logout'])->name('auth.logout');
});