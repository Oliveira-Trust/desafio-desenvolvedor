<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use DB;

class ClienteController extends Controller
{
    protected $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function clientePage(){
        $cliente = $this->cliente->all();

        return view('clientes', compact('cliente'));
    }

    public function clientesGet(){
        $cliente = $this->cliente->all();

        dd($cliente);
    }

    public function clienteGet($id){

        $cliente = $this->cliente->findOrFail($id);

        dd($cliente);
    }

    public function clienteCreate(Request $request){

        DB::transaction(function() use ($request){
            $cliente = $this->cliente->create($request->all());
        });

        return redirect(route('clientes'));
    }
    public function clienteUpdate($id, Request $request){

        $cliente = $this->cliente->findOrFail($id);

        DB::transaction(function() use ($cliente, $request) {
            $cliente->update($request->all());
        });

        return redirect(route('clientes'));
    }
    public function clienteDelete($ids){

        $delete_ids = explode(',', $ids);

        DB::transaction(function() use ($delete_ids){
            foreach($delete_ids as $id){
                $atualCliente = $this->cliente->findOrFail($id);

                $atualCliente->delete();
            }
        });

        return redirect(route('clientes'));
    }
}
