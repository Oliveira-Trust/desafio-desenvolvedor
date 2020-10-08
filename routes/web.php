<?php

use App\Http\Controllers\ClientController;
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

Route::prefix('clients')->group(function(){
    Route::get('', [ClientController::class, 'index'])
    ->name('index_client');
    Route::get('/create', [ClientController::class, 'create'])
        ->name('create_client');
    Route::post('', [ClientController::class, 'store'])
        ->name('store_client');
    Route::get('/{client}', [ClientController::class, 'show'])
        ->name('show_client');
    Route::get('/{client}/edit', [ClientController::class, 'edit'])
        ->name('edit_client');
    Route::patch('/{client}', [ClientController::class, 'update'])
        ->name('update_client');
    Route::delete('/{client}', [ClientController::class, 'destroy'])
    ->name('destroy_client');
});
