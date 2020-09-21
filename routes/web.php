<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('clients')->group(function (){
    Route::get('create', [ClientController::class,'create'])->name("clients.create");
    Route::get('{client}', [ClientController::class,'show'])->name('clients.show');
    Route::get('{client}/edit', [ClientController::class,'edit'])->name('clients.edit');
    Route::get('', [ClientController::class,'index'])->name('clients.index');
    Route::post('', [ClientController::class,'store'])->name("clients.store");
    Route::patch('{client}', [ClientController::class,'update'])->name("clients.update");
    Route::delete('{client}', [ClientController::class,'destroy'])->name("clients.destroy");
});

Route::prefix('products')->group(function (){
    Route::get('', [ProductController::class,'index'])->name('products.index');
    Route::get('create', [ProductController::class,'create'])->name("products.create");
    Route::get('{product}', [ProductController::class,'show'])->name('products.show');
    Route::get('{product}/edit', [ProductController::class,'edit'])->name('products.edit');
    Route::post('', [ProductController::class,'store'])->name("products.store");
    Route::patch('{product}', [ProductController::class,'update'])->name("products.update");
    Route::delete('{product}', [ProductController::class,'destroy'])->name("products.destroy");
});

Route::prefix('orders')->group(function (){
    Route::get('create', [OrderController::class,'create'])->name("orders.create");
    Route::get('{oder}', [OrderController::class,'show'])->name('orders.show');
    Route::get('{oder}/edit', [OrderController::class,'edit'])->name('orders.edit');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
