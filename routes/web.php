<?php

use App\Http\Controllers\ConversorController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::controller(ConversorController::class)->group(function () {
        Route::post('conversor', 'conversor')->name('conversor');
    });
});
