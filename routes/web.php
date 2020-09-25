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

Route::get('/', 'HomeController@index')->name('home');

//- ----------------------------------------------------------------------
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
//- ----------------------------------------------------------------------

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('clientes')->group(function () {
    Route::get('/', 'ManterClientesController@manter')->name('manterClientes');
    Route::post('filtrar', 'ManterClientesController@filtrar')->name('filtrarClientes');
    Route::get('{id}', 'ManterClientesController@obterPorId')->name('obterClientePorId');
    Route::post('salvar', 'ManterClientesController@salvar')->name('salvarCliente');
    Route::get('inativar/{id}', 'ManterClientesController@inativar')->name('excluirClientePorId');
    Route::post('inativarClientesMarcados', 'ManterClientesController@inativarClientesMarcados')->name('inativarClientesMarcados');
});

Route::prefix('produtos')->group(function () {
    Route::get('/', 'ManterProdutosController@manter')->name('manterProdutos');
    Route::post('filtrar', 'ManterProdutosController@filtrar')->name('filtrarProdutos');
    Route::get('{id}', 'ManterProdutosController@obterPorId')->name('obterProdutoPorId');
    Route::post('salvar', 'ManterProdutosController@salvar')->name('salvarProduto');
    Route::get('inativar/{id}', 'ManterProdutosController@inativar')->name('excluirProdutoPorId');
    Route::post('inativarProdutosMarcados', 'ManterProdutosController@inativarProdutosMarcados')->name('inativarProdutosMarcados');
});

Route::prefix('pedidos')->group(function () {
    Route::get('/', 'ManterPedidosController@manter')->name('manterPedidos');
    Route::post('filtrar', 'ManterPedidosController@filtrar')->name('filtrarPedidos');
    Route::get('{id}', 'ManterPedidosController@obterPorId')->name('obterPedidoPorId');
    Route::post('salvar', 'ManterPedidosController@salvar')->name('salvarPedido');
    Route::get('inativar/{id}', 'ManterPedidosController@inativar')->name('excluirPedidoPorId');
    Route::post('inativarPedidosMarcados', 'ManterPedidosController@inativarPedidosMarcados')->name('inativarPedidosMarcados');
});

Route::prefix('areaUsuario')->group(function () {
    Route::get('/', 'AreaUsuarioController@manter')->name('areaUsuario');
    Route::post('alterarDadosCadastrais', 'AreaUsuarioController@alterarDadosCadastrais')->name('alterarDadosCadastrais');
    Route::post('alterarSenha', 'AreaUsuarioController@alterarSenha')->name('alterarSenha');
});

Auth::routes();