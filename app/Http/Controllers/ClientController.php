<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ClientRequest;
use App\Repositories\ClientRepository;

class ClientController extends Controller
{
    /**
     * Exibe a listagem de clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.clientes.index');
    }

    /**
     * Exibe a página de criação de clientes.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('admin.clientes.create', compact('cities'));
    }

    /**
     * Cadastra um novo cliente.
     *
     * @param  ClientRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $user       =   User::create($request->only('name', 'email', 'password', 'enable'));
        $user->client()->create($request->only('document', 'phone_number', 'phone_number2', 'birth', 'address_zipcode', 'address_street', 'address_number', 'address_complement', 'address_neighborhood', 'city_id'));
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
        $cities = City::all();
        $cliente = $cliente->load('user', 'city', 'city.state');
        return view('admin.clientes.edit', compact('cliente', 'cities'));
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


    

    /**
     * Pesquisa e pagina os registros de clientes.
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request, ClientRepository $model){
        return $model->search($request->all());
    }



    public function deleteInMass(Request $request){
        try {
            Client::whereIn('id', $request->items)->delete();
            return response()->json([ 'status' => true, 'message' => count($request->items) > 1 ? 'Registros deletados com sucesso!' : 'Registro deletado com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'status' => false, 'message' => 'Erro ao deletar os registros.', 'th' =>  $th], 400);
        }
    }
}
