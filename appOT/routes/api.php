<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'authenticate'])->name('user.login'); 

Route::group(['middleware' => 'jwt.auth'], function () {
    // Rotas protegidas por JWT Auth

    Route::post('/create-conversion', 'ConversionController@createConversion');
    Route::get('conversion', [ConversionController::class, 'convert'])->name('conversion.convert');
    Route::get('conversion/history/{userid}', [ConversionController::class, 'getHistoryByUser'])->name('conversion.gethistory');

});



