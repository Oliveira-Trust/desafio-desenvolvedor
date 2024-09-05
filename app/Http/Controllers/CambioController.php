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

    public function consultaAPI(Request $request)
    {

        $urlBase = 'https://economia.awesomeapi.com.br/json/last/';
        $moedaOrigem = $request->moeda_origem;
        $moedaDestino = $request->moeda_destino;
        $response = Http::get($urlBase.$moedaOrigem.'-'.$moedaDestino)->json();

        $valorCompra = $request->valor;
        $valorCompra = (float) str_replace(['.', ','], ['','.'], $valorCompra);

        $valorCompra < 3000 ? $valorCompra = $valorCompra * 0.98 : $valorCompra = $valorCompra * 0.99;

        dd($valorCompra);

        $bid = $response[$moedaOrigem . $moedaDestino]['bid'];



        return response()->json($response);
    }
}
