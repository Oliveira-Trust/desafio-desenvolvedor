<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    //Lista com os clientes
    public function index()
    {
        $clientes = Cliente::simplePaginate(5);

        return view('clientes.index', compact('clientes'));
    }

    //Tela para criação de cliente
    public function create()
    {
        return view('clientes.create');
    }
     
    //Salva o registro de cliente
    public function store(Request $request)
    {
        Cliente::create($request->except('_token'));
        return redirect()->route('cliente_index')
            ->with('success', 'Cliente salvo com sucesso');
    }
}