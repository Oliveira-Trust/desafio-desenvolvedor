<?php

use App\Livewire\Conversor;
use Illuminate\Support\Facades\Route;

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/', Conversor::class)
    ->middleware(['auth'])
    ->name('conversor');

Route::get('conversor', Conversor::class)
->middleware(['auth'])
->name('conversor');


Route::get('teste', function () {
    return "acessou a rota teste";
});

require __DIR__.'/auth.php';
