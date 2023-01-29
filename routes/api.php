<?php

use App\Http\Controllers\AuthController;
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

Route::get('/user', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::get('/user-logout', [AuthController::class, 'userLogout'])->middleware('auth:sanctum');
Route::post('/user-register', [AuthController::class, 'userRegister']);
Route::post('/user-login', [AuthController::class, 'userLogin']);
