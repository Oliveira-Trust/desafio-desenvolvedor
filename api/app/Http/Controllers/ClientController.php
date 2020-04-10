<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends AbstractController
{
    /**
    * Define the Model for abstract Controller
    */
    protected function getModel()
    {
        return Client::class;
    }

    /**
    * Validate the request for abstract Controller
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
