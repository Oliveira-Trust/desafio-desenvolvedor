<?php

namespace App\Http\Controllers;

use App\Mail\ResumoCambio;
use App\Models\Config;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CambioController extends Controller
{
    public function index()
    {
        $url = 'https://economia.awesomeapi.com.br/json/last/USD-BRL';
        $retorno = Http::get($url)->json();
        $retornoString = json_encode($retorno);

        return view('cambio.index', compact('retornoString'));
    }

    public function resumo()
    {
        return view('cambio.resumo');
    }

    public function consultaAPI(Request $request)
    {
        $request->validate([
            'moeda_destino' => 'required',
            'pagamento' => 'required',
        ]);

        $configs = Config::findOrFail(1);

        //Parametros para acesso a API e outros dados do formulário
        $urlBase = 'https://economia.awesomeapi.com.br/json/last/';
        $moedaOrigem = $request->moeda_origem;
        $moedaDestino = $request->moeda_destino;
        $formaPagamento = $request->pagamento;

        //Consulta
        $response = Http::get($urlBase.$moedaOrigem.'-'.$moedaDestino)->json();

        //Manipulacao do valor de compra com as taxas (conversão e pagamento)
        $valor = $request->valor;
        $valorCompra = (float) str_replace(['.', ','], ['','.'], $valor);

        //taxa de conversao
        $taxaAcima = $configs->taxa_conv_acima != null ? (float) str_replace(['.', ','], ['','.'], $configs->taxa_conv_acima) / 100 : 0.01;
        $taxaAbaixo = $configs->taxa_conv_abaixo != null ? (float) str_replace(['.', ','], ['','.'], $configs->taxa_conv_abaixo) / 100 : 0.02;
        $valorCompra < 3000 ? $taxaConversao = $valorCompra * $taxaAbaixo : $taxaConversao = $valorCompra * $taxaAcima;

        //taxa de pagamento
        $taxaBoleto = $configs->taxa_boleto != null ? (float) str_replace(['.', ','], ['','.'], $configs->taxa_boleto) / 100 : 0.0145;
        $taxaCartao = $configs->taxa_cartao != null ? (float) str_replace(['.', ','], ['','.'], $configs->taxa_cartao) / 100 : 0.0763;
        $request->pagamento == 'BB' ? $taxaPagamento = $valorCompra * $taxaBoleto : $taxaPagamento = $valorCompra * $taxaCartao;

        //Recebendo retorno da API
        $bid = $response[$moedaOrigem . $moedaDestino]['bid'];

        //Definido o valor final
        $valorCompra = $valorCompra - $taxaConversao - $taxaPagamento;
        $valorConvertido = $valorCompra * $bid;


         $retorno = response()->json($response);

        return view('cambio.resumo',
            compact(
                'retorno',
                'valorCompra',
                'moedaDestino',
                'moedaOrigem',
                'taxaConversao',
                'taxaPagamento',
                'valorConvertido',
                'valor',
                'formaPagamento',
                'bid'
            ));
    }

    public function enviaEmail(Request $request)
    {
        $user = Auth::user()->email;
        Mail::to($user)->send(new ResumoCambio($user));

        //Inserindo registro na tabela de logs
        Logs::create([
            'user_id' => Auth::id(),
            'moeda_origem' => $request->moeda_origem,
            'valor_entrada' => $request->valor_conversao,
            'moeda_destino' => $request->moeda_destino,
            'valor_saida' => $request->valor_comprado,
            'forma_pagamento' => $request->forma_pagamento
        ]);

        return redirect()->route('cambio.index')->with('status', 'Operação realizada com sucesso! Verifique o seu e-mail');
    }
}
