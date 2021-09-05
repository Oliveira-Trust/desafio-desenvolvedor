<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
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


//Rotas Auth
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/password', [App\Http\Controllers\UserController::class, 'password'])->name('password')->middleware('auth');
Route::put('/password/{user}', [App\Http\Controllers\UserController::class, 'passwordChange'])->name('password.change')->middleware('auth');
Route::view('/welcome','welcome')->name('welcome')->middleware('auth');

//Rotas de Usuário
Route::resource('/user',UserController::class)->except(["destroy"])->middleware('auth');
Route::delete('/user/delete',[UserController::class,'destroy'])->name('user.destroy')->middleware('auth');

//Rotas de Produto
Route::resource('/product',ProductController::class)->except(["destroy","show"])->middleware('auth');
Route::delete('/product/delete',[ProductController::class,'destroy'])->name('product.destroy')->middleware('auth');

//Rotas de Compra
Route::resource('/purchase',PurchaseController::class)->except(["destroy"])->middleware('auth');
Route::delete('/purchase/delete',[PurchaseController::class,'destroy'])->name('purchase.destroy')->middleware('auth');

