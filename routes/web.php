<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductSaleController;
use App\Http\Controllers\LoginController;

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

Route::get('/status', [CategoryController::class, 'status']);

Route::get('/category/{order_by?}', [CategoryController::class, 'list']);
Route::get('/category/{id}', [CategoryController::class, 'show']);
Route::post('/category', [CategoryController::class, 'store']);
Route::put('/category/{id}', [CategoryController::class, 'update']);
Route::delete('/category/{id}', [CategoryController::class, 'delete']);

Route::get('/product/{order_by?}', [ProductController::class, 'list']);
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::post('/product', [ProductController::class, 'store']);
Route::post('/product/{id}/sendPhoto', [ProductController::class, 'sendPhoto']);
Route::patch('/product/{id}', [ProductController::class, 'update']);
Route::delete('/product/{id}', [ProductController::class, 'delete']);

Route::get('/sale/{order_by?}', [SaleController::class, 'list']);
Route::get('/sale/{id}', [SaleController::class, 'show']);
Route::post('/sale', [SaleController::class, 'store']);
Route::patch('/sale/{id}', [SaleController::class, 'update']);
Route::delete('/sale/{id}', [SaleController::class, 'delete']);

Route::get('/product_sale/{order_by?}', [ProductSaleController::class, 'list']);
Route::get('/product_sale/{id}', [ProductSaleController::class, 'show']);
Route::post('/product_sale', [ProductSaleController::class, 'store']);
Route::patch('/product_sale/{id}', [ProductSaleController::class, 'update']);
Route::delete('/product_sale/{id}', [ProductSaleController::class, 'delete']);

Route::get('/user/{order_by?}', [UserController::class, 'list']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::patch('/user/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'delete']);

Route::post('/login', [LoginController::class, 'authenticate']);
