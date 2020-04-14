<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientController extends AbstractController
{
    /**
    * Define the Model for abstract Controller
    *
    * @return \Illuminate\Database\Eloquent\Model
    */
    protected function getModel()
    {
        return Client::class;
    }

    /**
    * Display a listing of the resource.
    *
    * @queryParam name string required The name of the Client. Example: client1
    * @queryParam email string required The email of the Client. Example: client1@test.com
    * @queryParam document string required The document of the client. Example: 222222222
    * @queryParam birth string required The birth of the client. Example: 1996-07-15
    * @queryParam order_by array required array of key value. Key needs to be a attr of Client. Value can be either asc or desc. Example: ?order_by[name]=desc
    * @queryParam limit int required The limit of results. Example: 2
    * @queryParam offset int required The offset to skip number of results. Example: 1
    *
    * @param  Request  $request
    * @param  ClientRepositoryInterface  $clientRepository
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request, ClientRepositoryInterface $clientRepository)
    {
        $criterias = $request->except('order_by', 'limit', 'offset');
        $clients = $clientRepository->findBy($criterias, $request->order_by, $request->limit, $request->offset);
        return response()->json(['success' => true, 'data' => $clients]);
    }

    /**
    * Validate the request for abstract Controller
    *
    * @param  Request  $request
    */
    protected function modelValidation(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|email|unique:clients',
            'document' => 'required',
            'birth' => 'required',
        ],
        [
            'name.required' => 'Nome é obrigatório',
            'name.max' => 'Nome é muito grande',
            'email.required' => 'E-mail é obrigatório',
            'email.email' => 'E-mail inválido',
            'email.unique' => 'E-mail já existe',
            'document.required' => 'Documento é obrigatório',
            'birth.required' => 'Data de nascimento é obrigatório',
        ]);
    }
}
