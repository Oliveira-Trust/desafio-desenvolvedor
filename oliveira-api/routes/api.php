<?php

use App\Models\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HistoricController;
use App\Http\Controllers\CurrencyConversionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/currency', [CurrencyController::class, 'listAllCurrency']);

Route::get('/payment', [PaymentController::class, 'listAllPayments']);

Route::get('/historic', [HistoricController::class, 'listAllHistorics']);
Route::get('/historic/{user}', [HistoricController::class, 'listAllHistoricByUser']);

Route::get('/currency-conversion', [CurrencyConversionController::class, 'currencyConversion']);
