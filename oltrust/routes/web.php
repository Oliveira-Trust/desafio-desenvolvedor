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
    return view('admin/dashboard');
});

Route::resource('admin/clientes', 'Clientes\\clientesController')->middleware('auth');
Route::resource('admin/produtos', 'Produtos\\produtosController')->middleware('auth');
Route::resource('admin/pedidos', 'Pedidos\\pedidosController')->middleware('auth');
Route::resource('admin/condicoes', 'Pedidos\\condicoesController')->middleware('auth');

Route::get('admin/clientes', 'Clientes\\clientesController@index')->middleware('auth');
Route::get('admin/produtos', 'Produtos\\produtosController@index')->middleware('auth');
Route::get('admin/pedidos', 'Pedidos\\pedidosController@index')->middleware('auth');

Auth::routes();

Route::get('admin/dashboard', 'HomeController@index')->name('dashboard')->middleware('auth');
