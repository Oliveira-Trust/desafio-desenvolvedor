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

Route::get('/', 'PedidoController@index')->name('index');
Route::get('/produto', 'ProdutoController@index');
Route::get('/pedido', 'PedidoController@index');
Route::get('/clientes', 'ClienteController@view_cliente');
Route::get('/produtos', 'ProdutoController@view_produto');
Route::get('/pedidos', 'PedidoController@view_pedido');
Route::get('/novo_cliente', 'ClienteController@view_novo_cliente');
Route::get('/novo_produto', 'ProdutoController@view_novo_produto');
Route::get('/novo_pedido', 'PedidoController@view_novo_pedido');
