<?php

use App\Livewire\Conversor;
use App\Livewire\Taxa;
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


Route::get('taxas', Taxa::class)
    ->middleware(['auth'])
    ->name('taxas');

require __DIR__.'/auth.php';
