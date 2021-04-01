<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clientes;
class ClientesController extends Controller
{
    
    
  
    public function create()
    {
        return view('clientes.create');
    }
    public  function  store(Request $request)
    {
        
        \App\Models\Clientes::create([
            'nome_cliente' => $request->nome_cliente,
            'cnpj' => $request->cnpj,
            'endereco' => $request->endereco,
            'cep' => $request->cep,
            'uf' => $request->uf,
        ]);
        
        return redirect('clientes');
    }
    
    
    public function show($id)
    {
        $cliente = \App\Models\Clientes::findOrFail($id);
        return view('clientes.show',['cliente'=> $cliente]);
    }
    
    public function list()
    {
        $clientes = \App\Models\Clientes::all();
        
        
        return view('clientes.list',['clientes'=> $clientes]);
    }
    
    public  function  update(Request $request,$id)
    {
        
        $cliente = \App\Models\Clientes::findOrFail($id);
        $cliente->update([
            'nome_cliente' => $request->nome_cliente,
            'cnpj' => $request->cnpj,
            'endereco' => $request->endereco,
            'uf' => $request->uf,
            'cep' => $request->cep,
        ]);
        
        return redirect('clientes');
    }
    
    
    public function destroy($id)
    {
        $clientes = \App\Models\Clientes::findOrFail($id);
        $clientes->delete();
        return redirect('clientes');
    }
 
    
    
    //
}
