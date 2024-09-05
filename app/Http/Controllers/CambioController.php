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

        $retorno = Http::get($url)->json();

        $retornoString = json_encode($retorno);

        return $retornoString;
    }
}
