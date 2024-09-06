<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        //Parametros para acesso a API e outros dados do formulário
        $urlBase = 'https://economia.awesomeapi.com.br/json/last/';
        $moedaOrigem = $request->moeda_origem;
        $moedaDestino = $request->moeda_destino;
        $formaPagamento = $request->pagamento;

        //Consulta
        $response = Http::get($urlBase.$moedaOrigem.'-'.$moedaDestino)->json();

        //Manipulacao do valor de compra com as taxas
        $valor = $request->valor;
        $valorCompra = (float) str_replace(['.', ','], ['','.'], $valor);
        $valorCompra < 3000 ? $taxa = $valorCompra * 0.02 : $taxa = $valorCompra * 0.01;
        $valorCompra = $valorCompra - $taxa;

        //Recebendo retorno da API
        $bid = $response[$moedaOrigem . $moedaDestino]['bid'];

        $valorConvertido = $valorCompra * $bid;



         $retorno = response()->json($response);

        return view('cambio.resumo',
            compact(
                'retorno',
                'valorCompra',
                'moedaDestino',
                'moedaOrigem',
                'taxa',
                'valorConvertido',
                'valor',
                'formaPagamento',
                'bid'
            ));
    }
}
