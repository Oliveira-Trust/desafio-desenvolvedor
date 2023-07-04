<?php

use Illuminate\Http\Request;
use Modules\ConversorMoedas\Http\Controllers\ConversorMoedasController;
use App\Http\Controllers\AuthController as Autenticacao;

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

Route::middleware('auth:api')->get('/conversormoedas', function (Request $request) {
    return $request->user();
});

Route::post('register-user', [Autenticacao::class, 'registerUser']);
Route::post('login-user', [Autenticacao::class, 'login']);
Route::get('lista-moedas', [ConversorMoedasController::class, 'getAll']);

Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::post('moeda', [ConversorMoedasController::class, 'index']);
    Route::post('logout-user', [Autenticacao::class, 'logout']);
});

