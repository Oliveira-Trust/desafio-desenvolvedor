<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExchangeController;
use App\Http\Resources\ExchangeResource;
use App\Models\Exchange;
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

Route::get('/unauthenticated', function(){
    return ['error' => __('unauthenticated')];
})->name('login');

// Authentication and registration routes
Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::get('/user-logout', [AuthController::class, 'userLogout'])->middleware('auth:sanctum');
Route::post('/user-register', [AuthController::class, 'userRegister']);
Route::post('/user-login', [AuthController::class, 'userLogin']);

// API routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/exchange', ExchangeController::class);
    Route::get('/exchange', function () {
        $exchanges = Exchange::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return ExchangeResource::collection($exchanges);
    });
});
