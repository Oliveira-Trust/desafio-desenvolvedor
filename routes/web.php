<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login')->name('home');
Route::view('/login', 'auth.login')->name('login');
Route::view('/upload', 'upload.index')->middleware('auth')->name('uploads.page');
Route::view('/upload/history', 'upload.history')->middleware('auth')->name('uploads.history');
Route::view('/market-data', 'market-data.index')->middleware('auth')->name('market-data.index');
Route::redirect('/uploads', '/upload');
