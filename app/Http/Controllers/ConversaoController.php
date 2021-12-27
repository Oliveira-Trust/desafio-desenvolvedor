<?php

namespace App\Http\Controllers;

use App\Mail\SendMailUser;
use App\Models\Config;
use App\Models\Historico;
use App\Models\Moeda;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ConversaoController extends Controller
{

    public function index()
    {
        $moedasLiberadas = $this->consultaAPI();
        $moedaPadrao = Moeda::getMoedaPadrao();
        $formasPagamento = $this->getFormaPagamento();
        return view('index',['moedaPadrao'=>$moedaPadrao,'moedasLiberadas'=>$moedasLiberadas,'formas_pagamento'=>$formasPagamento]);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }

    private function getFormaPagamento(){


        return array("Boleto","Cartão de Crédito");
    }

    private function montaAcesso(){

        $moedasDisponiveis = Moeda::getMoedasDisponiveis();
        $listMontada = "";

        foreach($moedasDisponiveis as $moeda){
            $listMontada.=$moeda.',';
        }

        return  substr($listMontada,0,-1);
    }


    protected function consultaAPI()
    {

        $lista = $this->montaAcesso();

        $client = new Client(['base_uri' => env('URL_API_SERVICE'), 'verify' => false ]);
        $response = $client->request('GET', "/last/$lista");


        return json_decode($response->getBody()->getContents());

    }

    protected function consultaAPIAjax()
    {

        $lista = $this->montaAcesso();

        $client = new Client(['base_uri' => env('URL_API_SERVICE'), 'verify' => false ]);
        $response = $client->request('GET', "/last/$lista");


        return response()->json($response->getBody()->getContents());

    }

    public function processaCotacao(Request $request)
    {
        $config = Config::where('id','=',1)->get();

        /**
         * Adson Souza
         * Aqui eu poderia utilizar as taxas vindo do banco de dados,
         * basta utilizar o objeto acima mas vou deixar assim
         */

        $taxas = Moeda::getTaxas($request->forma_pagamento,$request->valor_compra);
        $valorTaxaPagamento = $request->valor_compra * $taxas['Taxa_pagamento'] / 100;
        $valorTaxaConversao = $request->valor_compra * $taxas['Taxa_conversao'] / 100;

        $valorConversao = $request->valor_compra ;
        $valorConversao -= $valorTaxaPagamento;
        $valorConversao -= $valorTaxaConversao;

        $valorConvertido = number_format($valorConversao / $request->valor_moeda_liberada,2,',','.');

        $request->request->add(['valorTaxaPagamento' => number_format($valorTaxaPagamento,2,',','.')]);
        $request->request->add(['valorTaxaConversao' => number_format($valorTaxaConversao,2,',','.')]);
        $request->request->add(['valorConversao' => number_format($valorConversao,2,',','.')]);
        $request->request->add(['valor_compra' => number_format($request->valor_compra,2,',','.')]);
        $request->request->add(['valorConvertido' => $valorConvertido]);
        $request->request->add(['simbolo' => Moeda::getSimboloMoeda($request->liberada)]);



        if(Auth::check() && Auth::user()->client){

            $dados_a_gravar = ['moeda_origem'=>$request->padrao,
                'moeda_destino'=>$request->liberada,
                'valor_conversao_original'=>$request->valor_compra,
                'forma_pagamento'=>$request->forma_pagamento,
                'valor_moeda'=>$request->valor_moeda_liberada,
                'valor_comprado'=>$valorConversao,
                'valor_taxa_pagamento'=>$valorTaxaPagamento,
                'valor_taxa_conversao'=>$valorTaxaConversao,
                'valor_conversao_com_taxa'=>$valorConvertido
            ];

            $historico = Historico::create($dados_a_gravar);
        }


        return view('cotacao',['dados'=>$request]);


    }

}
