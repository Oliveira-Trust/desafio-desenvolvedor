<?php

namespace App\Http\Controllers;

use App\Mail\ResumoCambio;
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
        $valorCompra < 3000 ? $taxaConversao = $valorCompra * 0.02 : $taxaConversao = $valorCompra * 0.01;
        //taxa de pagamento
        $request->pagamento == 'BB' ? $taxaPagamento = $valorCompra * 0.0145 : $taxaPagamento = $valorCompra * 0.0763;

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
        return redirect()->route('cambio.index')->with('status', 'Operação realizada com sucesso! Verifique o seu e-mail');
    }
}
