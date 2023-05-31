<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversorMoedaController;
use App\Http\Controllers\TaxaController;
use App\Http\Controllers\UsuarioController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */


Route::post('test', [TestController::class, 'testConversao']);

Route::prefix('usuario')->group(function () {
    Route::post('cadastrarUsuario', [UsuarioController::class, 'cadastrarUsuario']);
    Route::post('login', [UsuarioController::class, 'login']);
    Route::post('logout', [UsuarioController::class, 'logout']);
});

Route::post('conversaoMoeda', [ConversorMoedaController::class, 'conversaoMoeda']);
Route::post('historicoCotacaoMoeda', [ConversorMoedaController::class, 'historicoCotacaoMoeda']);

Route::prefix('taxa')->group(function () {
    Route::post('cadastrarTaxaConversao', [TaxaController::class, 'cadastrarTaxaConversao']);
    Route::post('cadastrarTaxaFormaPagamento', [TaxaController::class, 'cadastrarTaxaFormaPagamento']);
});
