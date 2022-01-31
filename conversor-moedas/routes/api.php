<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return response($request->user());
});

Route::get('/payment-methods', [App\Http\Controllers\PaymentMethodController::class, 'index'])
    ->name('payment-methods');

Route::get('/coins', [App\Http\Controllers\CoinController::class, 'index'])
    ->name('coins');

Route::group([
    'prefix' => '/conversions',
    'middlewares' => ['auth:sanctum']
], function () {
    Route::get('/', [App\Http\Controllers\ConversionController::class, 'index']);
    Route::post('/', [App\Http\Controllers\ConversionController::class, 'store']);
});
