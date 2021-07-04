<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ClientRequest;

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

        //dd($request->all());
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
    public function search(Request $request){
     
        $query = Client::query();

        // Ordendando por campo do registro
        switch ($request->sortBy) {
            case 'id':
            case 'phone_number':
            case 'phone_number2':
            case 'birth':
                $query->orderBy('clients.' . $request->sortBy, $request->sortDirection);
                break;
            case 'city_id':
                $query->orderBy('cities.name', $request->sortDirection);
                break;
            case 'name':
            case 'enable':
            case 'created_at':
            case 'updated_at':
                $query->orderBy('users.' . $request->sortBy, $request->sortDirection);
                break;
            default:
                # code...
                break;
        }

        $query->join('users', 'clients.user_id', '=', 'users.id')
        ->join('cities', 'clients.city_id', '=', 'cities.id');

        // Pesquisando o campo dos registros
        if (!empty($request->term) && !empty($request->field)) {
            switch ($request->field) {
                case 'id':
                case 'phone_number':
                case 'phone_number2':
                case 'birth':
                    $query->where('clients.' . $request->field , 'LIKE', '%' . $request->term . '%');
                    break;
                case 'city_id':
                    $query->where('cities.name', 'LIKE', '%' . $request->term . '%');
                    break;
                case 'name':
                case 'enable':
                case 'created_at':
                case 'updated_at':
                    $query->where('users.' . $request->field , 'LIKE', '%' . $request->term . '%');
                    break;
                default:
                    # code...
                    break;
            }
        }

        return $query->paginate(10, [
                        'clients.id as cid',
                        'users.id as uid',
                        'users.name as uname',
                        'users.created_at as ucreated', 
                        'users.updated_at as uupdated',
                        'cities.id as ciid', 
                        'cities.name as ciname', 
                        'cities.created_at as ccreated', 
                        'cities.updated_at as cupdated',
                        'birth', 
                        'phone_number', 
                        'phone_number2', 
                        'enable', 
                    ]);


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
