<?php

namespace App\Observers;

use App\Models\CotacaoModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CotacaoObserver
{
    public function created(CotacaoModel $cotacao)
    {
        echo "envia email";
        return true;
    }
}
