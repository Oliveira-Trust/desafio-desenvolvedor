<?php

namespace App\Observers;

use App\Mail\SendMailCotacao;
use App\Models\Cotacao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CotacaoObservable
{
    public function created(Cotacao $cotacao)
    {
        Mail::to(Auth::user()->email)->send(new SendMailCotacao(Auth::user(), $cotacao));
    }
}
