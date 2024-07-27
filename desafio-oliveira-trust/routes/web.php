<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversionController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function (){
    Route::get('conversion',[ConversionController::class, 'index'])->name('conversion');
    Route::post('convert', [ConversionController::class, 'convert']);
});

