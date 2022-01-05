<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CoinController;
use App\Http\Controllers\API\EmailController;
use App\Http\Controllers\API\HistoryController;

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

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('getcoins', [CoinController::class, 'getCoins'])->middleware('auth:sanctum');
Route::post('convert', [CoinController::class, 'convert'])->middleware('auth:sanctum');
Route::get('convert', [UserController::class, 'convert'])->middleware('auth:sanctum');
Route::post('sethistory', [HistoryController::class, 'setHistory'])->middleware('auth:sanctum');
Route::get('gethistory', [HistoryController::class, 'getHistory'])->middleware('auth:sanctum');

Route::post('sendemail', [EmailController::class, 'sendEmail'])->middleware('auth:sanctum');
