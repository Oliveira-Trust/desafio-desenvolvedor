<?php

use Illuminate\Support\Facades\Route;


use App\Mail\EnviaEmail;


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


Route::get('/cadastro', 'App\Http\Controllers\UsuarioController@form')->name('app.cadastro');
Route::post('/cadastro', 'App\Http\Controllers\UsuarioController@store')->name('app.form');


Route::get('/login', 'App\Http\Controllers\LoginController@index')->name('app.login');
Route::post('/login', 'App\Http\Controllers\LoginController@authenticate')->name('app.login');

Route::get('/logout', 'App\Http\Controllers\LoginController@logout')->name('app.logout');

Route::get('/cotacao', 'App\Http\Controllers\CotacaoController@index')->name('app.admin');
Route::post('/cotacao', 'App\Http\Controllers\CotacaoController@index')->name('app.admin.cotacao');

Route::get('/cotacao/minhas-cotacoes', 'App\Http\Controllers\HistoricoCotacaoController@index')->name('app.historico.cotacoes');

Route::post('/converte', 'App\Http\Controllers\CotacaoController@store')->name('app.converte');






