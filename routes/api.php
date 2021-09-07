<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClienteController;
use App\Http\Controllers\Api\ProdutoController;
use App\Http\Controllers\Api\PedidoCompraController;

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

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/refresh', [AuthController::class, 'refresh']);

Route::apiResource('/users', UserController::class);
Route::apiResource('/produtos', ProdutoController::class);
Route::apiResource('/clientes', ClienteController::class);
Route::apiResource('/pedidos', PedidoCompraController::class);