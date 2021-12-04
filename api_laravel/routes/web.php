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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('app.login');
Route::post('/login', 'App\Http\Controllers\LoginController@authenticate')->name('app.login');

Route::get('/cotacao', 'App\Http\Controllers\CotacaoController@get')->name('app.admin');
Route::post('/converte', 'App\Http\Controllers\CotacaoController@toConvert')->name('app.converte');
