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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){

    Route::group(['prefix' => 'clientes'], function(){
        Route::post('/create','ClienteController@clienteCreate')->name('cliente.create');
        Route::get('/update/{id}','ClienteController@clienteUpdate')->name('cliente.update');
        Route::get('/delete/{id}','ClienteController@clienteDelete')->name('cliente.delete');

        Route::get('/', 'ClienteController@clientePage')->name('clientes');

        // Route::get('/','ClienteController@clientesGet')->name('clientes.get');
        // Route::get('/{id}','ClienteController@clienteGet')->name('cliente.get');
    });    

    Route::group(['prefix' => 'produtos'], function(){
        Route::post('/create','ProdutoController@produtoCreate')->name('produto.create');
        Route::post('/edit/{id}','ProdutoController@produtoUpdate')->name('produto.edit');
        Route::post('/delete/{id}','ProdutoController@produtoDelete')->name('produto.delete');

        Route::get('/','ProdutoController@produtosGet')->name('produtos.get');
        Route::get('/{id}','ProdutoController@produtoGet')->name('produto.get'); 
    }); 

    Route::group(['prefix' => 'pedidos'], function(){
        Route::post('/create','PedidoController@pedidoCreate')->name('pedido.create');
        Route::post('/edit/{id}','PedidoController@pedidoUpdate')->name('pedido.edit');
        Route::post('/delete/{id}','PedidoController@pedidoDelete')->name('pedido.delete');

        Route::get('/','PedidoController@pedidosGet')->name('pedidos.get');
        Route::get('/{id}','PedidoController@pedidoGet')->name('pedido.get'); 
    });  
});