<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('clients')->group(function(){
    Route::get('', [ClientController::class, 'index'])
        ->name('index_client');
    Route::get('/create', [ClientController::class, 'create'])
        ->name('create_client');
    Route::post('', [ClientController::class, 'store'])
        ->name('store_client');
    Route::get('/{client}', [ClientController::class, 'show'])
        ->name('show_client');
    Route::get('/{client}/edit', [ClientController::class, 'edit'])
        ->name('edit_client');
    Route::patch('/{client}', [ClientController::class, 'update'])
        ->name('update_client');
    Route::delete('/{client}', [ClientController::class, 'destroy'])
    ->name('destroy_client');
});

Route::prefix('products')->group(function(){
    Route::get('', [ProductController::class, 'index'])
        ->name('index_product');
    Route::get('/create', [ProductController::class, 'create'])
        ->name('create_product');
    Route::post('', [ProductController::class, 'store'])
        ->name('store_product');
    Route::get('/{product}', [ProductController::class, 'show'])
        ->name('show_product');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])
        ->name('edit_product');
    Route::patch('/{product}', [ProductController::class, 'update'])
        ->name('update_product');
    Route::delete('/{product}', [ProductController::class, 'destroy'])
        ->name('destroy_product');
});

Route::prefix('orders')->group(function(){
    Route::get('', [OrderController::class, 'index'])
        ->name('index_order');
    Route::get('/create', [OrderController::class, 'create'])
        ->name('create_order');
    Route::post('', [OrderController::class, 'store'])
        ->name('store_order');
    Route::get('/{order}', [OrderController::class, 'show'])
        ->name('show_order');
    Route::get('/{order}/edit', [OrderController::class, 'edit'])
        ->name('edit_order');
    Route::patch('/{order}', [OrderController::class, 'update'])
        ->name('update_order');
    Route::delete('/{order}', [OrderController::class, 'destroy'])
        ->name('destroy_order');
});
