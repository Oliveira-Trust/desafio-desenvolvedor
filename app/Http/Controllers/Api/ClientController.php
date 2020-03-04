<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = filter_var_array($request, FILTER_SANITIZE_STRIPPED);
        
        $client = new Client();
        $client->name = $request->name;
        $client->datebirth = $request->datebirth;
        $client->cpf = $request->cpf;
        $client->telephone = $request->telephone;
    
        if (!$client->save()) {
            return response()->json(['error' => 'Erro ao cadastrar o cliente, verifique os dados.']);
        }
        
        return response()->json(['success' => 'Cliente cadastrado com sucesso!']);
    }

    /**
    * 
    * @param Client $client
    * @return type
    */
    public function show(Client $client)
    {
        return response()->json(['client' => $client]);
    }

    /**
     * 
     * @param Request $request
     * @param Client $client
     * @return type
     */
    public function update(Request $request, Client $client)
    {   
        $request = filter_var_array($request, FILTER_SANITIZE_STRIPPED);
        
        $client->name = $request->name;
        $client->datebirth = $request->datebirth;
        $client->cpf = $request->cpf;
        $client->telephone = $request->telephone;
        
        if (!$client->save()) {
            return response()->json(['error' => 'Erro ao editar o cliente, verifique os dados.']);
        }
        
        return response()->json(['success' => 'Cliente alterado com sucesso!']);
    }

    /**
     * 
     * @param Client $client
     * @return type
     */
    public function destroy(Client $client)
    {
        Client::destroy($client->id);
        
        return response()->json(['success' => 'Cliente excluído com sucesso!']);
    }
}
