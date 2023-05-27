<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoedaController;
use App\Http\Controllers\UsuarioController;
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

Route::post('/acesso', [UsuarioController::class, 'index']);
Route::post('/create-user', [UsuarioController::class, 'createUser']);
Route::get('/acesso-nivel/{email}', function ($email) {
    return view('acesso.validando', ['email' => $email]);
});

Route::get('/',[MoedaController::class, 'listarMoedas']);
Route::post('/converter',[MoedaController::class, 'converterMoeda']);
Route::post('/pagamento', function(){
    return view('main.pagamento');
});

Route::post('/register', function(){
    return view('auth.register');
});

Route::post('/login', function(){
    return view('auth.login');
});