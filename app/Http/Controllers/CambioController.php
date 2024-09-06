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

    private String $baseUrl;
    private String $moedaOrigem;

    public function __construct()
    {
        $this->baseUrl = "https://economia.awesomeapi.com.br/json/last/";
        $this->moedaOrigem = "USD-BRL";
    }

    public function stringToFloat($n)
    {
        $conversao = (float) str_replace(['.', ','], ['','.'], $n);

        return $conversao;
    }

    public function index()
    {
        $retorno = Http::get($this->baseUrl . $this->moedaOrigem)->json();
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
        $moedaOrigem = $request->moeda_origem;
        $moedaDestino = $request->moeda_destino;
        $formaPagamento = $request->pagamento;

        //Consulta
        $response = Http::get($this->baseUrl.$moedaOrigem.'-'.$moedaDestino)->json();

        //Manipulacao do valor de compra com as taxas (conversão e pagamento)
        $valor = $request->valor;
        $valorCompra = (float) str_replace(['.', ','], ['','.'], $valor);

        //taxa de conversao
        $taxaAcima = $configs->taxa_conv_acima != null ? $this->stringToFloat($configs->taxa_conv_acima) / 100 : 0.01;
        $taxaAbaixo = $configs->taxa_conv_abaixo != null ? $this->stringToFloat($configs->taxa_conv_abaixo) / 100 : 0.02;
        $valorCompra < 3000 ? $taxaConversao = $valorCompra * $taxaAbaixo : $taxaConversao = $valorCompra * $taxaAcima;

        //taxa de pagamento
        $taxaBoleto = $configs->taxa_boleto != null ? $this->stringToFloat($configs->taxa_boleto) / 100 : 0.0145;
        $taxaCartao = $configs->taxa_cartao != null ? $this->stringToFloat($configs->taxa_cartao) / 100 : 0.0763;
        $taxaPagamento = $request->pagamento == 'BB' ? $valorCompra * $taxaBoleto : $valorCompra * $taxaCartao;

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
