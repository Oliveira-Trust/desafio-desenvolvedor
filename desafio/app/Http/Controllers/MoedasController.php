<?php

namespace App\Http\Controllers;

use App\Moeda;
use App\Cotacoes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoedasController extends Controller
{   

    public function __construct()
    {
        $this->middleware('auth');   
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function conversor(Request $request)
    {

        $realConvertido = str_replace(',', '.', $request->dinheiro);

        $response = Http::get('https://economia.awesomeapi.com.br/json/last/' . $request->moeda);

       
        if ($response->failed()) {
            return response()->json("Erro ao conectar API", $response->status());
        } else {
            $moeda = new Moeda();
            $taxaConversao = $moeda->taxaConversao($realConvertido);
            $taxaPagamento = $moeda->taxaPagamento($request->formaPagamento, $realConvertido);
            $metodoEscolhido = $moeda->metodoEscolhido($request->formaPagamento);

            $valorConversao = $realConvertido - ($taxaPagamento + $taxaConversao);

            $conversao = array();

            foreach ($response->json() as $key => $val) {
                $valorComprado = $valorConversao / $val['bid'];
                $conversao[] = array(
                    'codein' => $val['codein'],
                    'code' => $val['code'],
                    'valorCotado' => $request->dinheiro,
                    'opcaoContra' => $metodoEscolhido,
                    'moedaDestino' => number_format($val['bid'], 2, ",", "."),
                    'taxaPagamento' => number_format($taxaPagamento, 2, ",", "."),
                    'taxaConversao' => number_format($taxaConversao, 2, ",", "."),
                    'valorConversao' => number_format($valorConversao, 2, ",", "."),
                    'valorComprado' => number_format($valorComprado, 2, ",", ".")
                );
            }

            Cotacoes::create([
                'user_id' => Auth::user()->id,
                'cotacao' => json_encode($conversao)
            ]);

            return response()->json($conversao, $response->status());
        }
    }

    public function cotacoesAnteriores(){

        $cotacoes = Cotacoes::where('user_id','=',Auth::user()->id)->orderBy('created_at','asc')->get();

        $cotacoesAnteriores = array();

        foreach($cotacoes as $val){
            $cotacaoAnterior = json_decode($val['cotacao']);
            $cotacoesAnteriores[] = array(
                'codein' => $cotacaoAnterior[0]->codein,
                'code' => $cotacaoAnterior[0]->code,
                'valorCotado' => $cotacaoAnterior[0]->valorCotado,
                'opcaoContra' => $cotacaoAnterior[0]->opcaoContra,
                'moedaDestino' => $cotacaoAnterior[0]->moedaDestino,
                'taxaPagamento' => $cotacaoAnterior[0]->taxaPagamento,
                'taxaConversao' => $cotacaoAnterior[0]->taxaConversao,
                'valorConversao' => $cotacaoAnterior[0]->valorConversao,
                'valorComprado' => $cotacaoAnterior[0]->valorComprado,
                'created_at' => date('d/m/Y H:m:i', strtotime($val->created_at))
            );
        }


        return response()->json($cotacoesAnteriores);
    }
}
