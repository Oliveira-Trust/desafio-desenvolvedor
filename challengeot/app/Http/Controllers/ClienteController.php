<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    protected $cliente;

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
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

        DB::transaction(function(){
            $cliente = $this->cliente->create($request->all());
        });

        dd($cliente);

        return redirect(route('home'));
    }
    public function clienteUpdate($id, Request $request){
        $cliente = $this->cliente->findOrFail($id);

        DB::transaction(function(){
            $cliente->update($request->all());
        });

        dd($cliente);
        return redirect(route('home'));
    }
    public function clienteDelete($ids){
        
        DB::transaction(function(){
            foreach($ids as $id){
                $atualCliente = $this->cliente->findOrFail($id);

                $atualCliente->delete();
            }
        });

        dd('hihi');
        return redirect(route('home'));
    }
}
