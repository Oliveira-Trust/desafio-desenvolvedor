<?php

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
   return view('pedidos.lista');
})->name('welcome');

Route::get('/clientes', 'ClientesWebController@index')->name('allClientes');
Route::get('/clientes/{id}', 'ClientesWebController@show');

Route::get('/produtos', 'ProdutosWebController@index')->name('allProdutos');
Route::get('/produtos/{id}', 'ProdutosWebController@show');

Route::get('/pedidos', 'PedidosWebController@index')->name('allPedidos');
Route::get('/pedidos/produtos/{id}', 'PedidosWebController@showProdutos');
Route::get('/pedidos/clientes/{id}', 'PedidosWebController@showClientes');
