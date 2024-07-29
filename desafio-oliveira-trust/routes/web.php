<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\EmailController;
use Illuminate\Support\Facades\Route;
Route::middleware('web')->group(function () {
    Route::get('/', [AuthController::class, 'showViewLogin'])->name('login');   
    Route::get('/conversion', [ConversionController::class, 'showViewConversion'])->name('conversion');
    Route::get('/conversion-results',[ConversionController::class, 'showViewResults'])->name('conversion-results');
    Route::get('/history',[ConversionController::class, 'showViewHistory'])->name('history');
    Route::post('/sendEmail', [EmailController::class, 'sendEmail'])->name('sendEmail');
});



