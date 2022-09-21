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

Route::get('login', 'LoginController@login')->name('login');
Route::post('login', 'LoginController@logar')->name('logar');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('layout.home');
    });

    Route::get('/conversao', 'ConversaoController@index')->name('conversao.index');
    Route::post('/conversao', 'ConversaoController@calcula')->name('conversao.calcula');

    Route::get('/historicos', 'HistoricoController@index')->name('historicos.index');

    Route::resource('configuracoes', ConfiguracaoController::class);
});
