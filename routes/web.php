<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'auth.login')->name('home');
Route::view('/login', 'auth.login')->name('login');
Route::view('/upload', 'upload.index')->middleware('auth')->name('uploads.page');
Route::view('/upload/history', 'upload.history')->middleware('auth')->name('uploads.history');
Route::redirect('/uploads', '/upload');
