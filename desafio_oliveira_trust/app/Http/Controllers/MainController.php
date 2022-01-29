<?php

namespace App\Http\Controllers;

use App\Mail\SendEmails;
use App\Models\Cotacoes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class MainController extends Controller
{
    public function main()
    {
        $response = Http::get('https://economia.awesomeapi.com.br/json/all');
        $moedas = json_decode($response->body());

        $cotacoes = Cotacoes::all();

        return view('main.main', compact('moedas','cotacoes'));
    }

    public function conversao(Request $request)
    {
        $dados = $request->all();
        $dados['valor_brl'] = str_replace('.', '', $dados['valor_brl']);
        $dados['valor_brl'] = str_replace(',', '.', $dados['valor_brl']);
        $dados['valor_brl'] = (float)$dados['valor_brl'];

        $validator = Validator::make($dados, [
            'valor_brl' => 'required|numeric|between:1000,100000',
            'moeda_converter' => 'required',
            'forma_pagamento' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        if ($dados['forma_pagamento']==='Boleto'){
            $taxa_pagamento = 1.45;
        }
        elseif ($dados['forma_pagamento']==='Cartão de Crédito'){
            $taxa_pagamento = 7.63;
        }
        if ($dados['valor_brl']<3000){
            $taxa_conversao = 2;
        }
        elseif ($dados['valor_brl']>=3000){
            $taxa_conversao = 1;
        }
        $valor_taxa_pagamento = ($dados['valor_brl']/100)*$taxa_pagamento;
        $valor_taxa_conversao = ($dados['valor_brl']/100)*$taxa_conversao;

        $response = Http::get('https://economia.awesomeapi.com.br/json/all');
        $moedas = json_decode($response->body());

        foreach ($moedas as $key => $moeda){
            if ($key === $dados['moeda_converter']){
                $valor_moeda_destino = (float)$moeda->bid;
            }
        }

        $moeda_origem = 'BRL';
        $moeda_destino = $dados['moeda_converter'];
        $valor_conversao_em_brl = $dados['valor_brl'];
        $forma_pagamento = $dados['forma_pagamento'];
        $valor_brl_descontado_taxas = $valor_conversao_em_brl - $valor_taxa_pagamento - $valor_taxa_conversao;
        $valor_moeda_convertida_total = $valor_brl_descontado_taxas/$valor_moeda_destino;

        $relatorio_completo = "
        Moeda de origem: $moeda_origem
        Moeda de destino: $moeda_destino
        Forma de pagamento: $forma_pagamento
        BID usado para conversão: $valor_moeda_destino
        Valor comprado: $valor_moeda_convertida_total
        Taxa de pagamento: $valor_taxa_pagamento
        Taxa de conversão: $valor_taxa_conversao
        Valor utilizado para conversão descontando as taxas: $valor_brl_descontado_taxas
        ";

        $cotacao = Cotacoes::create([
            'cotacoes' => $relatorio_completo
        ]);
        $cotacao->save();
        if (isset($dados['email'])){
            Mail::to('your_receiver_email@gmail.com')->send(new SendEmails($relatorio_completo));
        }




        return view('main.relatorio', compact('relatorio_completo'));
    }

}
