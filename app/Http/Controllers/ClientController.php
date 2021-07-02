<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Exibe a listagem de clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Client::get()->load('user', 'city');
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Exibe a página de criação de clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Cadastra um novo cliente.
     *
     * @param  ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        // adiciona o usuário e pega ele para usar o id abaixo
        $user       =   User::create($request->only('name', 'email', 'password', 'enable'));
        
        $add = [
            'user_id'               =>  $user->id, // usa o Id do usuário criado para atrelar a um novo cliente.
            'document'              =>  $request->document, 
            'phone_number'          =>  $request->phone_number, 
            'phone_number2'         =>  $request->phone_number2, 
            'birth'                 =>  $request->birth, 
            'address_zipcode'       =>  $request->address_zipcode, 
            'address_street'        =>  $request->address_street, 
            'address_number'        =>  $request->address_number, 
            'address_complement'    =>  $request->address_complement, 
            'address_neighborhood'  =>  $request->address_neighborhood, 
            'city_id'               =>  $request->city_id,
        ];

        // registra o novo cliente
        Client::create($add);

        return response()->json([ 'status' => true, 'message' => 'Registro adicionado com sucesso!'], 200);
    }

    /**
     * Exibe a página para editar o cliente.
     *
     * @param  Client  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $cliente)
    {
        $cliente = $cliente->load('user', 'city', 'city.state');
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Atualiza um cliente.
     *
     * @param  ClientRequest  $request
     * @param  Client  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $cliente)
    {
        $cliente->update($request->only('document', 'phone_number', 'phone_number2', 'birth', 'address_zipcode', 'address_street', 'address_number', 'address_complement', 'address_neighborhood', 'city_id'));
        $user = User::find($cliente->user_id);
        $user->update($request->only('name', 'email', 'password', 'enable'));
        return response()->json([ 'status' => true, 'message' => 'Registro atualizado com sucesso!'], 200);
    }

    /**
     * Remove um cliente.
     *
     * @param  Client  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $cliente)
    {
        $cliente->user->delete();
        return response()->json([ 'status' => true, 'message' => 'Registro deletado com sucesso!'], 200);
    }
}
