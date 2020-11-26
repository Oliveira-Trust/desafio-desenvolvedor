<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::get('/', [App\Http\Controllers\CustomerController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\CustomerController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\CustomerController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\CustomerController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [App\Http\Controllers\CustomerController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\CustomerController::class, 'show'])->name('show');
        Route::delete('/{id}/delete', [App\Http\Controllers\CustomerController::class, 'destroy'])->name('destroy');
        Route::put('/{id}/restore', [App\Http\Controllers\CustomerController::class, 'restore'])->name('restore');
        Route::delete('/{id}', [App\Http\Controllers\CustomerController::class, 'delete'])->name('delete');
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\ProductController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\ProductController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('edit');
        Route::patch('/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('update');
        Route::get('/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('show');
        Route::delete('/{id}/delete', [App\Http\Controllers\ProductController::class, 'destroy'])->name('destroy');
        Route::put('/{id}/restore', [App\Http\Controllers\ProductController::class, 'restore'])->name('restore');
        Route::delete('/{id}', [App\Http\Controllers\ProductController::class, 'delete'])->name('delete');
    });
});
