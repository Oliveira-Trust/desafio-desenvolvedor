<?php

namespace App\Observers;

use App\Models\CotacaoModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CotacaoObserver
{
    public function created(CotacaoModel $cotacao)
    {
        Mail::send('email.cotacao', ['dados' => $cotacao], function($message)
        {
            $message->from('leandro.p.alexandre@gmail.com', 'Sistema de cotações');
            $message->to(Auth::user()->email);
            $message->subject('Cotação cadastrada');
        });
        return true;
    }
}
