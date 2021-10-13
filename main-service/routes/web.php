<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PaymentMethodController;

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::get('/new-account', [LoginController::class, 'newAccount'])->name('new.account');
Route::post('/verify-login', [LoginController::class, 'verifyLogin'])->name('verify.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/store-user', [LoginController::class, 'storeUser'])->name('store.user');
Route::get('/revocer-password', [LoginController::class, 'recoverPassword'])->name('recover.password');
Route::post('/new-password', [LoginController::class, 'newPassword'])->name('new.password');

//Rotas acessíveis somente com user logado
Route::group(['middleware' => ['auth']], function () {

    Route::get('index', [HomeController::class, 'index'])->name('index');

    //Quotation
    Route::post('/quotation', [HomeController::class, 'quotation'])->name('quotation');
    Route::get('/historic-quotation-user', [HomeController::class, 'getAllQuotationsByUser'])->name('quotation.by.user');
    Route::get('/all-historic-quotation', [HomeController::class, 'getAllQuotations'])->name('quotation.all');

    //Routes by Admin
    Route::prefix('admin')->group(function () {
        //Currency
        Route::resource('currencies', CurrencyController::class);

        //Payment Method
        Route::resource('payment-methods', PaymentMethodController::class);

        //Fees
        Route::resource('fees', FeeController::class);
    });
});
