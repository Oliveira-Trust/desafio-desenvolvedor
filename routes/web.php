<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('products')->group(function (){
    Route::get('', [ProductController::class,'index'])->name('products.index');
    Route::get('create', [ProductController::class,'create'])->name("products.create");
    Route::post('', [ProductController::class,'store'])->name("products.store");
    Route::get('{product}', [ProductController::class,'show'])->name('product.show');
    Route::get('{product}/edit', [ProductController::class,'edit'])->name('products.edit');
    Route::patch('{product}', [ProductController::class,'update'])->name("product.update");
    Route::delete('{product}', [ProductController::class,'destroy'])->name("product.destroy");
});
