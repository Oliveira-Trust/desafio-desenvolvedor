<?php

    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\ConversaoController;


    Route::get('/', [ConversaoController::class, 'index']);
    Route::get('/consulta', [ConversaoController::class, 'consultaAPIAjax']);
    Route::post('/cotacao', [ConversaoController::class, 'processaCotacao'])->name('cotacao');

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');



    Route::middleware(['admin'])->group(function () {
        Route::get('/admin', 'AdminController@dashboard')->name('admin.dashboard');
        Route::put('/admin:id', 'AdminController@update')->name('admin.update');


    });

    Route::middleware(['client'])->group(function () {

        Route::get('/profile', 'ClientController@profile')->name('profile');

    });
