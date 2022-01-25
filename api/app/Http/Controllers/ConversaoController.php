<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Conversao;
use Illuminate\View\View;
use Redirect;


class ConversaoController extends Controller
{
    public function converter(Request $request)
    {
        $moedaOrigem = 'BRL';
        $moedaDestino = $request->get('moeda-destino');
        $valorConversao = $request->get('valor-conversao');

        if($valorConversao <= 1000) {
            return back()->withErrors([
                'Valor da compra deve ser maior que R$1.000'
            ]);
        }

        if($valorConversao >= 100000) {
            return back()->withErrors([
                'Valor da compra deve ser menor que R$100.000'
            ]);
        }

        $formaPagamento = $request->get('forma-pagamento');

        $moedas = [
            '1' => 'USD',
            '2' => 'EUR'
        ];

        $pagamentos = [
            '1' => ['metodo' => 'Boleto', 'taxa' => 1.45],
            '2' => ['metodo' => 'Cartão de Crédito', 'taxa' => 7.63]
        ];

        $taxaPagamento = ($valorConversao * $pagamentos[$formaPagamento]['taxa']) / 100;
        $taxaConversao = $valorConversao < 3000 ? (($valorConversao * 2)/100) : (($valorConversao * 1)/100);

        $valorConverter = $valorConversao - $taxaPagamento - $taxaConversao;

        $response = Http::get("https://economia.awesomeapi.com.br/{$moedas[$moedaDestino]}/1");
        $responseJson = $response->body();
        $data = json_decode($responseJson, true)[0];

        $valorCompra = $data['bid'];

        $valorConvertido = $valorConverter / $valorCompra;
        $valorConvertido = number_format($valorConvertido, 2,'.','');

        // Salvar Conversão do usuário
        $userId = Auth::id();

        $dadosConversao = [
            'moeda_origem' => $moedaOrigem,
            'moeda_destino' => $moedas[$moedaDestino],
            'valor_conversao' => $valorConversao,
            'forma_pagamento' => $pagamentos[$formaPagamento]['metodo'],
            'valor_moeda_destino' => $valorCompra,
            'valor_comprado' => $valorConvertido,
            'taxa_pagamento' => $taxaPagamento,
            'taxa_conversao' => $taxaConversao,
            'valor_converter' => $valorConverter,
            'user_id' => $userId
        ];

        $conversao = Conversao::create($dadosConversao);

        $dadosConversao = [
            'moeda_origem' => $moedaOrigem,
            'moeda_destino' => $moedas[$moedaDestino],
            'valor_conversao' => number_format($valorConversao, 2,',','.'),
            'forma_pagamento' => $pagamentos[$formaPagamento]['metodo'],
            'valor_moeda_destino' => number_format($valorCompra, 2,',','.'),
            'valor_comprado' => number_format($valorConvertido, 2,',','.'),
            'taxa_pagamento' => number_format($taxaPagamento, 2,',','.'),
            'taxa_conversao' => number_format($taxaConversao, 2,',','.'),
            'valor_converter' => number_format($valorConverter, 2,',','.'),
            'user_id' => $userId
        ];

        $dados = array_merge($dadosConversao, ['moeda-destino' => $moedaDestino,'valor-conversao' => $valorConversao, 'forma-pagamento' => $formaPagamento]);



        return Redirect::route('home')->with('dados', $dados);
    }
}
