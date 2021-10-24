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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/user-cotacoes/calcular', [App\Http\Controllers\Api\v1\UserCotacaoController::class, 'calcular']);
Route::apiResource('v1/user-cotacoes', App\Http\Controllers\Api\v1\UserCotacaoController::class);
Route::apiResource('v1/cotacoes-taxas', App\Http\Controllers\Api\v1\Cotacao\CotacaoTaxaController::class);
Route::apiResource('v1/cotacoes-taxas-ranges', App\Http\Controllers\Api\v1\Cotacao\CotacaoTaxaRangeController::class);
Route::apiResource('v1/tipos-cobrancas', App\Http\Controllers\Api\v1\Tipo\TipoCobrancaController::class);
Route::apiResource('v1/dominios-itens', App\Http\Controllers\Api\v1\Dominio\DominioItemController::class);
Route::apiResource('v1/moedas', App\Http\Controllers\Api\v1\Moeda\MoedaController::class);

