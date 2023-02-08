<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\TradeController;


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

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/home',[HomeController::class,'home'])->name('home');

Route::get('/edituser',[UserController::class,'edit'])->name('admin.editUser');
Route::post('/edituser',[UserController::class,'update'])->name('admin.editUser');

Route::get('/trocarsenha',[ConfirmPasswordController::class,'changePass'])->name('admin.trocarSenha');
Route::post('/trocarsenha',[ConfirmPasswordController::class,'updChangePass'])->name('admin.trocarSenha');

Route::get('/trade',[TradeController::class,'index'])->name('admin.trade');
Route::post('/trade',[TradeController::class,'trade'])->name('admin.trade');


