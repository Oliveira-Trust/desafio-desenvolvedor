<?php

use App\Http\Controllers\ConversionFeeController;
use App\Http\Controllers\CurrencyConversionController;
use App\Http\Controllers\PaymentFeeController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('conversion', function () {
        return view('registercurrencyconversion');
    })->name('conversion');
    Route::get('currencyConversion', [CurrencyConversionController::class, 'currencyConversion'])->name('currencyConversion');

    Route::get('history', [CurrencyConversionController::class, 'historyCotationCurrency'])->name('history');

    Route::get('paymentFee', function () {
        return view('registerpaymentfee');
    })->name('paymentFee');
    Route::get('registerPaymentFee', [PaymentFeeController::class, 'registerPaymentFee'])->name('registerPaymentFee');

    Route::get('conversionFee', function () {
        return view('registerconversionfee');
    })->name('conversionFee');
    Route::get('registerConversionFee', [ConversionFeeController::class, 'registerConversionFee'])->name('registerConversionFee');
});

require __DIR__ . '/auth.php';
 


/* Route::view('login', 'login')->name('login');

Route::post('login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('conversao');
    });

    Route::view('conversao', 'conversao')->name('conversao');
    Route::view('cadastrartaxaconversao', 'cadastrartaxaconversao')->name('cadastrartaxaconversao');
    Route::view('cadastrartaxapagamento', 'cadastrartaxapagamento')->name('cadastrartaxapagamento');
    Route::get('historicoCotacaoMoeda', [ConversorMoedaController::class, 'historicoCotacaoMoeda'])->name('historicoCotacaoMoeda');
});
 */

 //Route::get('historicoCotacaoMoeda', [ConversorMoedaController::class, 'historicoCotacaoMoeda'])->name('historicoCotacaoMoeda');