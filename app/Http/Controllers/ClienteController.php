<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    //Tela para criação de cliente
    public function create()
    {
        return view('clientes.create');
    }
     
    //Salva o registro de cliente
    public function store(Request $request)
    {
        Cliente::create($request->except('_token'));
    }
}