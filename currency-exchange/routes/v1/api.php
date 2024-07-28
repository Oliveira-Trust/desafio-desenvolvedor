<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Exchange\ExchangeController;
use App\Http\Controllers\Api\Fee\FeeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
  Route::post('register', [AuthController::class, 'register'])->name('register');
  Route::post('login', [AuthController::class, 'login'])->name('login');

  Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('/fees', FeeController::class);

    Route::resource('/exchanges', ExchangeController::class)->only(['index', 'show', 'store']);
  });
});
