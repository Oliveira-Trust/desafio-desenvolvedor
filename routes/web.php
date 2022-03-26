<?php

use App\Http\Controllers\CurrencyController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CurrencyController::class)->middleware(['auth'])->group(function(){
    Route::get('/dashboard', 'index')->name('dashboard');
    Route::get('/get-currencies-purchases', 'getCurrenciesPurchases')->name('get-currencies-purchases');
    Route::post('/buy-currency', 'buyCurrency')->name('buy-currency');
    Route::post('/get-converted-currency', 'getConvertedCurrency')->name('get-converted-currency');
});

require __DIR__.'/auth.php';
