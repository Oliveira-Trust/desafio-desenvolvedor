<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConverterController;
use App\Http\Controllers\CurrencyController;

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

Route::get(
    '/converter',
    ConverterController::class
)->name('converter');

Route::get(
    '/currencies',
    CurrencyController::class
)->name('currencies');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
