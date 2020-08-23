<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::all();
        return response()->Json([
            'client' => $client,
            'res' => ' O recurso solicitado foi processado e retornado com sucesso.'
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = [              
            'name' => $request->name,
            'email' => $request->email,
            'adress' => $request->adress,
        ];           
        $client = Client::create($dados);                          
            if ($client) {
                return response()->Json([
                    'client'=> $client,
                    'res'=>'O recurso informado foi criado com sucesso.'
                ], 201);
            }
        return response()->Json([
            'res'=>'A requisição foi recebida com sucesso, porém contém parâmetros inválidos.'
        ], 422);     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Client::findOrFail($id);     
        return response()->Json([
            'client'=> $client,
            'res'=>'O recurso solicitado foi processado e retornado com sucesso.'
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id) {           
            $client = Client::findOrFail($id);

            if($client){
                 
                $data = $request->all();           
                $client->update($data);
                return response()->Json([
                    'client'=> $client,
                    'res'=>'O recurso informado foi alterado com sucesso.'
                ], 201);   
            } 
            return response()->Json([
                'res'=>'A requisição foi recebida com sucesso, porém contém parâmetros inválidos.'
            ], 422); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);        
        if($client->delete()){
            return response()->Json([
                'client'=> $client,
                'res'=>'O recurso informado foi deletado com sucesso.'
            ], 201);;  
        }
        return response()->Json([
            'res'=>'A requisição foi recebida com sucesso, porém contém parâmetros inválidos.'
        ], 422);
    }
}