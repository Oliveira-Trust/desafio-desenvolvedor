<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use App\Http\Requests\ConversaoMoedaRequest;
use App\Taxas\Taxas;

class ConversorMoedaController extends Controller
{
    public function converterMoeda(ConversaoMoedaRequest $request)
    {
        $retornoConversao = ApiService::converterMoeda($request->moedaDestino);
        $valorCompraMoeda = $retornoConversao[$request->moedaDestino . 'BRL']['bid'] ?? 0;
        $valorCompradoMoeda = $request->valorConversao / $valorCompraMoeda;
        $taxas = new Taxas($request->formaPagamento, $request->valorConversao);
        $taxaPagamento = ($taxas->retornaTaxaFormaPagamento()['percentualTaxa'] * $request->valorConversao) / 100;
        $taxaConversao = ($taxas->retornaTaxaValorConversao() * $request->valorConversao) / 100;
        $totalTaxasConvertidas = ($taxaPagamento + $taxaConversao) / $valorCompraMoeda;
        return  response()->json([
            'moedaOrigem'       => 'BRL',
            'moedaDestino'      => $request->moedaDestino,
            'valorConversao'    => $request->valorConversao,
            'formaPagamento'    => $taxas->retornaTaxaFormaPagamento()['descricao'],
            'valorMoedaDestino' => $valorCompraMoeda,
            'valorCompradoMoedaDestino' => $valorCompradoMoeda - $totalTaxasConvertidas,
            'taxaPagamento' => $taxaPagamento,
            'taxaConversao' => $taxaConversao,
            'valorConversaoDescontos' => $request->valorConversao - $taxaPagamento - $taxaConversao,
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
