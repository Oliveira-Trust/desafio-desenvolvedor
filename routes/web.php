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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/produto/cadastrar', 'ProductsController@create')->name('produto.cadastrar');
Route::post('/produto/salvar', 'ProductsController@store')->name('produto.salvar');
Route::get('/produto/editar/{id}','ProductsController@show')->name('produto.editar');
Route::get('/produto/excluir/{id}','ProductsController@destroy')->name('produto.excluir');
Route::get('/produtos','ProductsController@index')->name('produtos');


Route::get('/pedidos','OrderController@index')->name('pedidos');
Route::post('/pedidos/salvar','OrderController@store')->name('pedidos.salvar');

Route::post('/produto/pedido/remover','OrderProductController@destroy')->name('produto.pedido.remover');


Route::get('/clientes','ClientController@index')->name('clientes');
Route::get('/cliente/cadastrar','ClientController@create')->name('cliente.cadastrar');
Route::post('/cliente/salvar','ClientController@store')->name('cliente.salvar');
