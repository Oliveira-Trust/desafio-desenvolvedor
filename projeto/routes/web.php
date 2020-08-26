<?php


/* Produtos. ****************************************************** */
Route::get('/produtos/criar', 'ProdutosController@criar');
Route::post('/produtos/criar', 'ProdutosController@criar_produto')->name('criar_produto');

Route::get('/produtos/ver/{id}', 'ProdutosController@ver');
Route::get('/produtos/listar', 'ProdutosController@listar');
Route::get('/produtos/', 'ProdutosController@listar');

Route::get('/produtos/alterar/{id}', 'ProdutosController@alterar');
Route::post('/produtos/alterar/{id}', 'ProdutosController@alterar_produto')->name('alterar_produto');

Route::get('/produtos/remover/{id}', 'ProdutosController@remover');
Route::post('/produtos/remover/{id}', 'ProdutosController@remover_produto')->name('remover_produto');
Route::post('/produtos/remover_produtos', 'ProdutosController@remover_produtos')->name('remover_produtos');


/* Clientes. ****************************************************** */
Route::get('/clientes/criar', 'ClientesController@criar');
Route::post('/clientes/criar', 'ClientesController@criar_cliente')->name('criar_cliente');

Route::get('/clientes/ver/{id}', 'ClientesController@ver');
Route::get('/clientes/listar', 'ClientesController@listar');
Route::get('/clientes/', 'ClientesController@listar');

Route::get('/clientes/alterar/{id}', 'ClientesController@alterar');
Route::post('/clientes/alterar/{id}', 'ClientesController@alterar_cliente')->name('alterar_cliente');

Route::get('/clientes/remover/{id}', 'ClientesController@remover');
Route::post('/clientes/remover/{id}', 'ClientesController@remover_cliente')->name('remover_cliente');
Route::post('/clientes/remover_clientes', 'ClientesController@remover_clientes')->name('remover_clientes');


/* Pedidos. ******************************************************* */
Route::get('/pedidos/criar', 'PedidosController@criar');
Route::post('/pedidos/criar', 'PedidosController@criar_pedido')->name('criar_pedido');

Route::get('/pedidos/ver/{id}', 'PedidosController@ver');
Route::get('/pedidos/listar', 'PedidosController@listar');
Route::get('/pedidos/', 'PedidosController@listar');

Route::get('/pedidos/alterar/{id}', 'PedidosController@alterar');
Route::post('/pedidos/alterar/{id}', 'PedidosController@alterar_pedido')->name('alterar_pedido');

Route::get('/pedidos/remover/{id}', 'PedidosController@remover');
Route::post('/pedidos/remover/{id}', 'PedidosController@remover_pedido')->name('remover_pedido');
Route::post('/pedidos/remover_pedidos', 'PedidosController@remover_pedidos')->name('remover_pedidos');

/* **************************************************************** */


Route::get('/home', 'HomeController@index');
Route::get('/', 'HomeController@index');
