<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaymentMethodController;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

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

Route::group(['prefix' => '/v1'], function () {
    Route::post('/users/authenticate', [UserController::class, 'authenticate'])->name('user.login');


    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/users', [UserController::class, 'listUsers'])->name('user.listUsers');
        Route::get('users/{id}', [UserController::class, 'getUser'])->name('user.getuser');
        Route::get('authenticate-duser', [UserController::class, 'getAuthenticatedUser'])->name('user.getuser');
        Route::post('refreshtoken', [UserController::class, 'refreshToken'])->name('user.refreshtoken');

        //Conversion Routes
        Route::post('/create-conversion', 'ConversionController@createConversion');
        Route::post('conversion', [ConversionController::class, 'convert'])->name('conversion.convert');
        Route::get('conversion/history/{userid}', [ConversionController::class, 'getHistoryByUser'])->name('conversion.gethistory');

        //Payment Method Routes
        Route::get('/payment-methods', [PaymentMethodController::class, 'index'])->name('payment_methods.index');
        Route::get('/payment-methods/create', [PaymentMethodController::class, 'create'])->name('payment_methods.create');
        Route::post('/payment-methods', [PaymentMethodController::class, 'store'])->name('payment_methods.store');
        Route::get('/payment-methods/{id}', [PaymentMethodController::class, 'show'])->name('payment_methods.show');
        Route::put('/payment-methods/{id}', [PaymentMethodController::class, 'update'])->name('payment_methods.update');
        //Route::delete('/payment-methods/{payment_method}', [PaymentMethodController::class, 'destroy'])->name('payment_methods.destroy');

    });
});
