<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\FeesSetupController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('payment_fees', FeesSetupController::class, ['names'=>['index'=>'payment_fees']]);

Route::resource('payment_methods', PaymentMethodsController::class, ['names'=>['index'=>'payment_methods']]);

Route::get('/dashboard', [MainController::class, 'trade'])->middleware(['auth'])->name('dashboard');

Route::post('/dashboard', [MainController::class, 'tradePost'])->middleware(['auth'])->name('currency_trade');

Route::get('/history', [MainController::class, 'history'])->middleware(['auth'])->name('history');

require __DIR__.'/auth.php';
