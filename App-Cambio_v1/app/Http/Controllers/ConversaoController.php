<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ConversaoController extends Controller
{
    public function index()
    {
        return view('conversao');
    }

    public function listarMoedas()
    {
        $response = Http::get('https://economia.awesomeapi.com.br/json/all');
        $moedas = $response->json();

        return response()->json($moedas);
    }

    public function converter(Request $request)
    {
        $request->validate([
            'moeda_destino' => 'required',
            'valor' => 'required|numeric|min:1000|max:100000',
            'forma_pagamento' => 'required|in:boleto,cartao',
        ]);

        $moedaDestino = $request->input('moeda_destino');
        $valor = $request->input('valor');
        $formaPagamento = $request->input('forma_pagamento');
          
        // Fetch conversion rate
        $response = Http::get("https://economia.awesomeapi.com.br/json/last/{$moedaDestino}-BRL");
        $data = $response->json();
        $cotacao = $data["{$moedaDestino}BRL"]['bid'];
          
        // Calculate payment fee
        $taxaPagamento = ($formaPagamento == 'boleto') ? 1.45 : 7.63;
        $valorComTaxaPagamento = $valor - ($valor * ($taxaPagamento / 100));

        // Calculate conversion fee
        $taxaConversao = ($valor < 3000) ? 2 : 1;
        $valorComTaxaConversao = $valorComTaxaPagamento - ($valorComTaxaPagamento * ($taxaConversao / 100));

        // Final value in foreign currency
        $valorConvertido = $valorComTaxaConversao / $cotacao;

        return view('resultado', compact('moedaDestino', 'valor', 'formaPagamento', 'cotacao', 'valorConvertido', 'taxaPagamento', 'taxaConversao', 'valorComTaxaPagamento', 'valorComTaxaConversao'));
    }

    public function obterCotacao($moeda)
    {
        $response = Http::get("https://economia.awesomeapi.com.br/last/BRL-{$moeda}");
        return response()->json($response->json()["BRL{$moeda}"]['bid']);
        
    }
}

