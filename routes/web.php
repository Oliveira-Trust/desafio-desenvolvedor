<?php

use App\Http\Controllers\ConversorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(ConversorController::class)->group(function () {
        Route::post('conversor', 'conversor')->name('conversor');
    });
});
