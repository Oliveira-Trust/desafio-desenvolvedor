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

Route::get('/', function () { return view('auth.login'); });

Auth::routes();

Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/', [App\Http\Controllers\CurrencyConversionController::class, 'index']);
    Route::get('/home', [App\Http\Controllers\CurrencyConversionController::class, 'index'])->name('home');

    Route::get('CurrencyConversion/datatables/', [App\Http\Controllers\CurrencyConversionController::class, 'datatable'])->name('CurrencyConversion.Datatable');
    Route::resource('CurrencyConversion', App\Http\Controllers\CurrencyConversionController::class);
    
    Route::get('User/datatables/', [App\Http\Controllers\UserController::class, 'datatable'])->name('User.Datatable');
    Route::resource('User', App\Http\Controllers\UserController::class);

    Route::resource('CurrencyTax', App\Http\Controllers\CurrencyTaxController::class);

    Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

});
