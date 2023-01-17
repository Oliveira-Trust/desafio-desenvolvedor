<?php

use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\LoginController;
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

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/exchange', [ExchangeController::class, "create"]);
    Route::get('/exchange', [ExchangeController::class, "list"]);
});

Route::post('/login', [LoginController::class, "login"]);

