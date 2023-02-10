<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TaxaController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ConversaoController;
use App\Http\Controllers\UserController;

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




//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => ['auth']], function () {

Route::get('/consumirapi' , [ApiController::class, 'getCotacoes'] );
Route::get('/' , [ConversaoController::class, 'index'] )->name("conversao.index");
Route::get('/getallcotacoes' , [ConversaoController::class, 'getAllCotacao'] );
Route::post('/save_cotacao' , [ConversaoController::class, 'store'] )->name("save.cotacao");

Route::get('/send_email' , [ConversaoController::class, 'sendEmail'] )->name("send.email");


Route::get('/taxas' , [TaxaController::class, 'index'] )->name("taxa.index");
Route::get('/all_taxas' , [TaxaController::class, 'getAll'] )->name("taxa.getall");
Route::post('/save_taxa' , [TaxaController::class, 'store'] )->name("save.taxa");
Route::get('/get_taxa/{taxa}' , [TaxaController::class, 'show'] )->name("show.taxa");
Route::put('/update_taxa' , [TaxaController::class, 'update'] )->name("update.taxa");
Route::delete('/delete_taxa/{id}' , [TaxaController::class, 'destroy'] )->name("delete.taxa");  
Route::get('/taxa_conversao' , [TaxaController::class, 'TaxaConversao'] );

Route::get('/calculo_conversao' , [TaxaController::class, 'CalculoConversao'] );


Route::get('/logout2' , [UserController::class, 'logout'] )->name("user.logout"); 




});

 




