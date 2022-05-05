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

Route::get('/', 'App\Http\Controllers\GuestController@index')->name('index');
Route::post('/exchange/results', 'App\Http\Controllers\GuestController@results')->name('exchange.results');

Route::middleware(['auth',App\Http\Middleware\AdminAccessCheck::class])->prefix('admin')->name('admin.')->group(function () {
    
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('exchange')->name('exchange.')->group(function(){
        Route::get('/email/{exchange_id}', 'App\Http\Controllers\GuestController@sendMail')->name('email');
        Route::get('/show/{exchange_id}', 'App\Http\Controllers\GuestController@show')->name('show');
        Route::get('/history', 'App\Http\Controllers\GuestController@history')->name('history');
    });
    
});


require __DIR__.'/auth.php';
