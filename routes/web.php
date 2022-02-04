<?php

use Illuminate\Support\Facades\Route;
use App\Http\Models\ConversoesMoeda;

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
// dd('s');
Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cadastrar', function () {
    return view('auth.cadastrar');
});
Route::post('/cadastrar', 'Auth\CadastrarController@create')->name('cadastrar');
Route::prefix('moedas')->group(function () {
    Route::get('/cotacoes','Moedas\ConversoesController@index')->name('conversoes_moedas.index')->middleware(['auth']);
    Route::get('/cotacoes/adicionar','Moedas\ConversoesController@adicionar')->name('conversoes_moedas.adicionar')->middleware(['auth']);
    Route::post('/cotacoes','Moedas\ConversoesController@salvar')->name('conversoes_moedas.salvar')->middleware(['auth']);
    Route::get('/cotacoes/visualizar/{cotacao}','Moedas\ConversoesController@visualizar')->name('conversoes_moedas.visualizar')->middleware(['auth']); 
    Route::get('/cotacoes/editar/{cotacao}/{aba?}','Moedas\ConversoesController@editar')->name('conversoes_moedas.editar')->middleware(['auth']); 
    Route::delete('/cotacoes/{cotacao}','Moedas\ConversoesController@deletar')->name('conversoes_moedas.deletar')->middleware(['auth']); 
    Route::get('/cotacoes/relatorio','Moedas\ConversoesController@relatorio')->name('conversoes_moedas.relatorio')->middleware(['auth']); 
});
Route::prefix('gerencial')->group(function () {
    //Taxa de forma de pagamento
    Route::get('/forma-pagamento-taxa','Gerencial\FormaPagamentoTaxasController@index')->name('forma_pagamento_taxas.index')->middleware(['auth']);
    Route::get('/forma-pagamento-taxa/editar/{empresa}/{aba?}','Gerencial\FormaPagamentoTaxasController@editar')->name('forma_pagamento_taxas.editar')->middleware(['auth']); 
    Route::put('/forma-pagamento-taxa/{empresa}','Gerencial\FormaPagamentoTaxasController@atualizar')->name('forma_pagamento_taxas.atualizar')->middleware(['auth']); 
    //Taxa de conversão
    Route::get('/conversao-taxa','Gerencial\ConversaoTaxasController@index')->name('conversao_taxas.index')->middleware(['auth']);
    Route::get('/conversao-taxa/editar/{empresa}/{aba?}','Gerencial\ConversaoTaxasController@editar')->name('conversao_taxas.editar')->middleware(['auth']); 
    Route::put('/conversao-taxa/{empresa}','Gerencial\ConversaoTaxasController@atualizar')->name('conversao_taxas.atualizar')->middleware(['auth']); 
   //Usuarios
    Route::get('/usuarios','Gerencial\UsuariosController@index')->name('usuarios.index')->middleware(['auth']);
    Route::get('/usuario/meus-dados/{usuario}','Gerencial\UsuariosController@meusDados')->name('usuarios.meus_dados')->middleware(['auth']);
    Route::put('/usuario/meus-dados/{usuario}','Gerencial\UsuariosController@atualizarMeusDados')->name('usuarios.atualizar_meus_dados')->middleware(['auth']); 
    // Route::get('/usuarios/meus-dados/{usuario}','Gerencial\UsuariosController@meusDados')->name('usuarios.meus_dados')->middleware(['auth']);
    
    Route::get('/usuario/alterar-senha/{usuario}','Gerencial\UsuariosController@alterarSenha')->name('usuarios.alterar_senha')->middleware(['auth']); 
    Route::put('/usuario/alterar-senha/{usuario}','Gerencial\UsuariosController@atualizarSenha')->name('usuarios.atualizarSenha')->middleware(['auth']);  
    Route::post('/usuario/alterar-foto/{usuario}','Gerencial\UsuariosController@atualizarFoto')->name('usuarios.atualizarFoto')->middleware(['auth']); 
});

Route::get('envia-mail/{cotacao_id}', function ($cotacao_id) {

    $objConversoesMoeda =  new ConversoesMoeda();
    $conversaoMoeda = $objConversoesMoeda->buscarPorId($cotacao_id);
    $conversao = [];
    $conversao = [
        'Moeda de origem: ' .$conversaoMoeda->moeda_origem.' - Real',
        'Moeda de destino: '.$conversaoMoeda->moeda_destino.' - '.($conversaoMoeda->moeda_destino == 'USD' ? 'Dollar Americano' : 'Euro'),
        'Forma de pagamento: '.($conversaoMoeda->forma_pagamento == 'B' ? 'Boleto' : 'Cartão') ,
        'Valor para conversão: R$ '.\App\Helpers\FormataHelper::formataValor($conversaoMoeda->valor_conversao),
        'Taxa de pagamento: R$ ' .\App\Helpers\FormataHelper::formataValor($conversaoMoeda->taxa_pagamento),
        'Taxa de conversão: R$ ' .\App\Helpers\FormataHelper::formataValor($conversaoMoeda->taxa_conversao),
        'Valor utilizado para conversão: R$ ' .\App\Helpers\FormataHelper::formataValor($conversaoMoeda->valor_final_conversao),
        'Valor moeda de destino: R$ ' .\App\Helpers\FormataHelper::formataValor($conversaoMoeda->valor_moeda_destino),
        'Valor comprado: R$ ' .\App\Helpers\FormataHelper::formataValor($conversaoMoeda->valor_comprado_moeda_destino)
    ];
    $cotacao = [
        'cotacao_id' => $cotacao_id,
        'dados' => $conversao,
    ];
   
    \Mail::to('pedro.phnb@gmail.com')->send(new \App\Mail\CotacaoEmail($cotacao));
   
    // dd("Email is Sent.");
})->name('email.envia');