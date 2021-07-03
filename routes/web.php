<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['prefix' => 'admin', 'as' => 'admin.'], function() {
        
    Route::resource('clientes' ,  App\Http\Controllers\ClientController::class)->except('show');

    Route::get('/clientes/buscar', [App\Http\Controllers\ClientController::class, 'search'])->name('search');
    Route::post('/clientes/delete-in-mass', [App\Http\Controllers\ClientController::class, 'deleteInMass'])->name('deleteInMass');
    
});
