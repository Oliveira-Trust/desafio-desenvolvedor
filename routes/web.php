<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes(); 

Route::get('/', 'HomeController@index')->name('index');
Route::post('/busca', 'HomeController@busca')->name('index.busca');

Route::get('/produto/{id}', 'HomeController@produto')->name('produto');
Route::get('/carrinho', 'CarrinhoController@index')->name('carrinho.index');
Route::get('/carrinho/adicionar', function() {
    return redirect()->route('index');
});
Route::post('/carrinho/adicionar', 'CarrinhoController@adicionar')->name('carrinho.adicionar');
Route::delete('/carrinho/remover', 'CarrinhoController@remover')->name('carrinho.remover');
Route::post('/carrinho/concluir', 'CarrinhoController@concluir')->name('carrinho.concluir');
Route::get('/carrinho/compras', 'CarrinhoController@compras')->name('carrinho.compras');
Route::post('/carrinho/cancelar', 'CarrinhoController@cancelar')->name('carrinho.cancelar');
Route::post('/carrinho/desconto', 'CarrinhoController@desconto')->name('carrinho.desconto');

// rotas do admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('produtos', 'Admin\ProdutoController@index')->name('admin.produtos');
    Route::get('produtos/adicionar', 'Admin\ProdutoController@adicionar')->name('admin.produtos.adicionar');
    Route::post('produtos/salvar', 'Admin\ProdutoController@salvar')->name('admin.produtos.salvar');
    Route::get('produtos/editar/{id}', 'Admin\ProdutoController@editar')->name('admin.produtos.editar');
    Route::put('produtos/atualizar/{id}', 'Admin\ProdutoController@atualizar')->name('admin.produtos.atualizar');
    Route::get('produtos/deletar/{id}', 'Admin\ProdutoController@deletar')->name('admin.produtos.deletar');

    Route::get('clientes', 'Admin\ClienteController@index')->name('admin.clientes');
    Route::get('clientes/adicionar', 'Admin\ClienteController@adicionar')->name('admin.clientes.adicionar');
    Route::post('clientes/salvar', 'Admin\ClienteController@salvar')->name('admin.clientes.salvar');
    Route::get('clientes/editar/{id}', 'Admin\ClienteController@editar')->name('admin.clientes.editar');
    Route::put('clientes/atualizar/{id}', 'Admin\ClienteController@atualizar')->name('admin.clientes.atualizar');
    Route::get('clientes/deletar/{id}', 'Admin\ClienteController@deletar')->name('admin.clientes.deletar');

    Route::get('pedidos', 'Admin\PedidoController@index')->name('admin.pedidos');
});