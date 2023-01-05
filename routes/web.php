<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConversorController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(ConversorController::class)->group(function () {
        Route::post('conversor', 'conversor')->name('conversor');
    });

    Route::controller(AdminController::class)->prefix('/admin')->name('admin.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/pagamento', 'pagamento')->name('pagamento');
        Route::post('/taxa', 'taxa')->name('taxa');
    });
});
