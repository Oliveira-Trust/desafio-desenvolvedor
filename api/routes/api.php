<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConverterController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\AuthController;

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

Route::prefix('/user')->prefix('user')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'revokeUserTokens']);
    Route::post('/', [AuthController::class, 'authenticate']);
});
