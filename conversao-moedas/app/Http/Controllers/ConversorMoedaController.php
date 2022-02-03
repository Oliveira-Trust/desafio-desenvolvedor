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
            'valorConversao'    => number_format($request->valorConversao, 2, ',', '.'),
            'formaPagamento'    => $taxas->retornaTaxaFormaPagamento()['descricao'],
            'valorMoedaDestino' => number_format($valorCompraMoeda, 2, ',', '.'),
            'valorCompradoMoedaDestino' => number_format(($valorCompradoMoeda - $totalTaxasConvertidas), 2, ',', '.'),
            'taxaPagamento' => number_format($taxaPagamento, 2, ',', '.'),
            'taxaConversao' => number_format($taxaConversao, 2, ',', '.'),
            'valorConversaoDescontos' => number_format(($request->valorConversao - $taxaPagamento - $taxaConversao), 2, ',', '.'),
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
