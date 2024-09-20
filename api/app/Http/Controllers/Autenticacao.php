<?php

namespace App\Http\Controllers;

use App\Http\Requests\Registro;
use App\Models\User;
use App\Services\UsuarioService;

class Autenticacao extends Controller
{

    public function __construct(private UsuarioService $usuarioService)
    {
        
    }
     public function registro(Registro $request)
     {
            return response()->json($this->usuarioService->registrar($request));
     }
}
