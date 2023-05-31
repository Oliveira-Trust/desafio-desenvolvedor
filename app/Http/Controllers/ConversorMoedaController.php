<?php

namespace App\Http\Controllers;

use App\Models\CotacaoMoeda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TaxaConversao;
use App\Models\TaxaFormaPagamento;
use Illuminate\Support\Facades\Http;
use App\Services\ConversaoMoedaService;
use Illuminate\Support\Facades\Auth;

class ConversorMoedaController extends Controller
{



    /**
     *
     * Fazer a conversão do valor para conversão informado para a moeda destino, calculando aplicando as taxas e regras
     *
     * @param string moedaDestino Exemplo: EUR, USD 
     * @param decimal valorConversao Exemplo:1200
     * @param integer tipoFormaPagamento  Exemplo:1(boleto) 2(cartão de crédito)
     * @param integer user_id Exemplo:1
     * @return json Lista os dados detalhados do resultado da conversão do valor informado
     */

    public function conversaoMoeda(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'moedaDestino' => 'required',
            'valorConversao' => 'required',
            'tipoFormaPagamento' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 403);
        }

        //Testa se o valor da conversao está entre os valores de 1000 a 100000
        if ($request->valorConversao < 1000 || $request->valorConversao > 100000) {
            return response()->json(['error_code' => 10006, 'error_msg' => 'O valor de conversão tem que estar entre 1000 e 100000'], 403);
        }

        $taxaConversao = TaxaConversao::orderBy('id', 'desc')->get()->first();
        //Aplica a taxa de conversão ao valor de conversão, chamando a função(calcularTaxaConversao) para realizar os cálculos
        $valorConversaoAplicadoTaxaConversao = $taxaConversao->calcularTaxaConversao($request->valorConversao);
        $valorTaxaConversao = $valorConversaoAplicadoTaxaConversao - $request->valorConversao;

        //Aplica a taxa para formma de pagamento, chamando uma função(calcularTaxaFormaPagamento) para realizar os cálculos
        $taxaFormaPagamento = TaxaFormaPagamento::where('tipo_forma_pagamento', $request->tipoFormaPagamento)->orderBy('created_at', 'desc')->get()->first();
        $descrFormaPagamento =  $taxaFormaPagamento->descricao;
        $valorTotalAplicadoTaxas = $taxaFormaPagamento->calcularTaxaFormaPagamento($valorConversaoAplicadoTaxaConversao);
        $valorTaxaFormaPagamento = $valorTotalAplicadoTaxas -  $valorConversaoAplicadoTaxaConversao;

        $valorTotalTaxasAplicadas = $valorTaxaConversao +  $valorTaxaFormaPagamento;
        //Executa a função cotacaoMoedaDestino que irá realizar a cotaçãa do valor para conversão, de acordo com as moedas de origem(BRL) e de destino
        $cotacaoMoeda = new CotacaoMoeda();
        $resultadoCotacaoMoeda =  $cotacaoMoeda->cotacaoMoedaDestino($request->moedaDestino);
       
        $paramsCotacaoEmail = [
            'emailTo' => 'flaviateles.r@gmail.com',
            'emailFrom' => 'flaviateles.r@gmail.com',
            'valorMoedaDestino' => $resultadoCotacaoMoeda['bid'],
            'valorConversao' => $request['valorConversao'],
            'moedaOrigem' => $resultadoCotacaoMoeda['code'],
            'moedaDestino' => $resultadoCotacaoMoeda['codein'],
            'descricaoMoedaOrigemDestino' => $resultadoCotacaoMoeda['name'],
            'valorMoedaDestino' => $resultadoCotacaoMoeda['bid'],
        ];

        //A função (emailCotacaoMoeda) irá disparar um Job que enviará um email informando ao usuário todas as cotações solicitadas
        $cotacaoMoeda->emailCotacaoMoeda($paramsCotacaoEmail);

        $valorMoedaDestino = $resultadoCotacaoMoeda['bid'];
        //O valorConvertido é o valor da conversão aplicadas todas as taxas
        $valorConvertido = $valorTotalAplicadoTaxas + ($valorTotalAplicadoTaxas / 100 * $valorMoedaDestino);
        $valorCompradoMoedaDestino = $valorConvertido - $request['valorConversao'];
        $valorConversaoDescontadoTaxa = $request['valorConversao'] - $valorTotalTaxasAplicadas;
            
        $params = [
            'valorConversao' => $request['valorConversao'],
            'tipoFormaPagamento' => $request['tipoFormaPagamento'],
            'moedaOrigem' => 'BRL',
            'moedaDestino' => $request['moedaDestino'],
            'valorMoedaDestino' => $valorMoedaDestino,
            'valorTaxaPagamento' => $valorTaxaFormaPagamento,
            'valorTaxaConversao' => $valorTaxaConversao,
            'valorConvertido' => $valorConvertido,
            'user_id' => $request->user_id
        ];

        //Inserir na tabela contacao_moedas a conversão realizada
        $cotacaoMoeda->cadastrarCotacaoMoedaPorUsuario($params);

        //Montar um array com os dados a serem mostradas no retorno da api
        $resultadoCotacaoMoeda = [
            'moedaOrigem' => $params['moedaOrigem'],
            'moedaDestino' => $params['moedaDestino'],
            'valorConversao' => (number_format($params['valorConversao'], 2, ',', '.')),
            'formaPagamento' => $descrFormaPagamento,
            'valorMoedaDestino' => (number_format($params['valorMoedaDestino'], 2, ',', '.')),
            'valorCompradoMoedaDestino' => (number_format($valorCompradoMoedaDestino, 2, ',', '.')),
            'valorTaxaPagamento' => (number_format($params['valorTaxaPagamento'], 2, ',', '.')),
            'valorTaxaConversao' => (number_format($params['valorTaxaConversao'], 2, ',', '.')),
            'valorConversaoDescontadoTaxa' => (number_format($valorConversaoDescontadoTaxa, 2, ',', '.')),
        ];

        return response()->json(['resultado' => $resultadoCotacaoMoeda], 200);
    }

     /**
     *
     * Histórico com todas as cotações realizadas por usuário
     * @return array Lista os dados detalhados do resultado das cotações do usuário
     */

    public function historicoCotacaoMoeda()
    {
        $records = CotacaoMoeda::select('cotacao_moedas.*')->where('cotacao_moedas.user_id', Auth::user()->id)
            ->orderBY('created_at', 'DESC')->get();

        return response()->view('historicocotacaomoeda', ['cotacoes' => $records]);
    }
}
