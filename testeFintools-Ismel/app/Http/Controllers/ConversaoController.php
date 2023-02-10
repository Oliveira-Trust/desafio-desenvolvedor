<?php

namespace App\Http\Controllers;

use App\Models\Cotacao;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SendMailUser;
use Illuminate\Support\Facades\Mail;


class ConversaoController extends Controller
{
    public function index()
    {
        return view('cotacao');
    }

    public function getAllCotacao(Request $request)
    {
        $result = User::find($request->id)->cotacoes;               
        return    response()->json($result, 200);
    } 


    public function store(Request $request)
    { 
        $this->validate($request,[
            'moeda_origem' => ['required'],
            'moeda_destino' => ['required'],
            'valor_conversao' => ['required'],
            'forma_pagamento' => ['required'],
            'valor_usado_conversao' => ['required'],
            'valor_comprado' => ['required'],
            'taxa_pagamento' => ['required'],
            'taxa_conversao' => ['required'],
            'data_transacao' => ['required'],
            'user_id' => ['required']
        ],[
            'moeda_origem.required' => 'O campo moeda origem não pode ser vazio',
            'moeda_destino.required' => 'O campo moeda destino não pode ser vazio',
            'valor_conversao.required' => 'O campo valor conversão não pode ser vazio',
            'forma_pagamento.required' => 'O campo forma pagamento não pode ser vazio',
            'valor_usado_conversao.required' => 'O campo valor usado conversao não pode ser vazio',
            'valor_comprado.required' => 'O campo valor comprado não pode ser vazio',
            'taxa_pagamento.required' => 'O campo taxa pagamento não pode ser vazio',
            'taxa_conversao.required' => 'O campo taxa conversão não pode ser vazio',
            'data_transacao.required' => 'O campo data transação não pode ser vazio',
            'user_id.required' => 'O campo user_id não pode ser vazio'
        ]);
        
        Cotacao::create($request->all());       
        return "success";       
    }

    public function sendEmail(Request $request)
    {
        
        //return new SendMailUser($request);
        Mail::send(new SendMailUser($request));
        $result= "success";
        return response()->json($result, 200);

        
    } 
}











