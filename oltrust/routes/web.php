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

Route::resource('admin/clientes', 'Clientes\\clientesController');
Route::resource('admin/produtos', 'Produtos\\produtosController');
Route::resource('admin/status', 'Status\\statusController');
Route::resource('admin/condicao', 'Condicao\\condicaoController');
Route::resource('admin/statuses', 'Statuses\\statusesController');
Route::resource('admin/condicoes', 'Condicoes\\condicoesController');
Route::resource('admin/pedidos', 'Pedidos\\pedidosController');