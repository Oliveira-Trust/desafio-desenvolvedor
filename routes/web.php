<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login')->name('home');
Route::view('/login', 'auth.login')->name('login');
Route::view('/upload', 'upload.index')->name('uploads.page');
Route::view('/upload/history', 'upload.history')->name('uploads.history');
Route::redirect('/uploads', '/upload');
