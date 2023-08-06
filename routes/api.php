<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\HistoryConversionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login',[AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api', 'prefix' => 'conversion'], function () {

    Route::post('',[ConversionController::class,'convert']);
    Route::get('history',[HistoryConversionController::class,'index']);
});
