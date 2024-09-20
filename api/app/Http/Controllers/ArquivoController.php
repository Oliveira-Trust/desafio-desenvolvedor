<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Response as HttpResponse;

class ArquivoController extends Controller
{
            public function enviar(): HttpResponse
            {
                    return  response(Arquivo::all()->toArray(), 200, ['Content-Type' => 'application/json']);
            }
}
