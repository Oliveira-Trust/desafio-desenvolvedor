<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ExemploMail;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/testar-email', function () {
    $mailData = [
        'title' => 'This is Test Mail'
    ];

    Mail::to('email@example.com')->send(new ExemploMail($mailData));
    return 'E-mail enviado com sucesso!';
});
