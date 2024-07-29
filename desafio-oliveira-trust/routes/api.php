<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversionController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'apiLogin'])->name('api.login');

Route::middleware('auth:api')->group(function () {    
    Route::post('/convert', [ConversionController::class, 'convert']);    
    Route::get('/showHistory', [ConversionController::class, 'showHistory'])->name('showHistory');
});