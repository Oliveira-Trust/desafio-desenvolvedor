<?php

use App\Http\Controllers\Auth\AuthCheckController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\UserController;
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

Route::post('signup', SignupController::class);

Route::post('login', LoginController::class);

Route::get('user/{user_id}', [UserController::class, 'show']);


Route::group(['middleware' => ['auth:sanctum']],function(){

    Route::get('me', function (Request $request) {
        return $request->user();
    });

    Route::get('auth_check', AuthCheckController::class);

    Route::post('logout', LogoutController::class);

});



