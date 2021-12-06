<?php

namespace App\Http\Controllers;

use Mail;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\HistoricoCotacao as Historico;

use App\Mail\EnviaEmail;

class CotacaoController extends Controller
{

    protected $taxa;

    protected $conversao;

    public function __construct() 
    {
        $this->taxa = new Taxas;
    }

    public function index() 
    {
        $name = session()->get('name');

        if (!isset($name)) {
            return redirect()->route('app.login', ['error' => 1 ]);
        }
        return view('app.admin');
    }

    public function store(ApiController $cotacao, Request $request) 
    {

        $this->conversao = $this->taxa->toConvertBRL($cotacao, $request);

        if ($request->valor_conversao > $this->taxa::VALOR_MIN_COMPRA && $request->valor_conversao < $this->taxa::VALOR_MAX_COMPRA) {

            $this->execute($this->conversao);
        }    

        return redirect()->route('app.historico.cotacoes');
    }

    protected function execute($conversao) 
    {
        $historico = new Historico;

        $historico->create([ 
            'user_id' => $conversao['user_id'],
            'taxa_conversao' => $conversao['taxa_conversao'],
            'taxa_pagamento' => $conversao['taxa_pagamento'],
            'moeda_destino' => $conversao['moeda_destino'],
            'moedas_comprada' => $conversao['moedas_comprada'],
            'total_conversao' => $conversao['total_conversao'],
            'moeda' => $conversao['moeda']
        ])->save();

       // Pega o e-mail do usuário logado
       $destinatario = session()->get('email');

       Mail::to($destinatario)->send( new EnviaEmail([ 
            'user_id' => $conversao['user_id'],
            'taxa_conversao' => $conversao['taxa_conversao'],
            'taxa_pagamento' => $conversao['taxa_pagamento'],
            'moeda_destino' => $conversao['moeda_destino'],
            'moedas_comprada' => $conversao['moedas_comprada'],
            'total_conversao' => $conversao['total_conversao'],
            'moeda' => $conversao['moeda']
        ] ));           
    }

}
