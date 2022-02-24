<?php

namespace App\Http\Controllers;

use App\Models\FormasPagamento;
use Illuminate\Http\Request;

class TaxasController extends Controller
{

    public const VALOR_MIN_COMPRA = 1000;
    public const VALOR_MAX_COMPRA = 100000;
    public const VALOR_CONVERSAO = 3000;

    public function toConverter(CotacaoApi $cotar, Request $request)
    {
        $valorTotal = (float) $request->valor;
        $moedaOrigem  = $request->moeda_origem;
        $moedaDestino = $request->moeda_destino;

        //buscar cotação atual
        $cotacaoMoeda = $cotar->getCotacaoValor($moedaOrigem, $moedaDestino);

        $cotacaoMoeda = $cotacaoMoeda['body'][$moedaDestino.$moedaOrigem] ?? [];
        $cotacao = $cotacaoMoeda['ask'] ?? 0;

        //taxa de pagamento
        $pagamento = $this->pagamento($request->forma_pagamento);
        $taxaPagamento = ($valorTotal * $pagamento->taxa) / 100;

        //taxa de conversao
        $taxa = $this->taxaConversao($valorTotal);
        $taxaConversao = ($valorTotal * $taxa) / 100;

        //descontos para calcular total
        $totalTotal = $valorTotal - $taxaPagamento - $taxaConversao;

        return [
            'user_id' => 1,
            'moeda_origem' => $moedaOrigem,
            'moeda_destino' => $moedaDestino,
            'valor_conversao' => $valorTotal,
            'forma_pagamento' => $pagamento->nome,
            'valor_moeda_destino' => $cotacao,
            'valor_comprado' => !$cotacao ? 0 : ($valorTotal / $cotacao),
            'taxa_pagamento' => $taxaPagamento,
            'taxa_conversao' => $taxaConversao,
            'total_descontato' =>  $totalTotal
       ];
    }

    public function validarMaxMin($valor)
    {
        if ($valor >= self::VALOR_MAX_COMPRA ) {
            return redirect()->back()->withErrors(['errors_max' =>'O valor da compra deve ser menor que 100.000,00 BRL ']);
        } else if ($valor <= self::VALOR_MIN_COMPRA ) {
            return redirect()->back()->withErrors(['errors_min' =>'O valor da compra deve ser superior a 1.000,00 BRL']);
        }
    }

    /**
     * retorna a taxa de acordo com o tipo de pagamento
     * @param string
     *
     * @return FormasPagamento
     */
    public function pagamento($id)
    {
        return FormasPagamento::findOrFail($id);
    }

    /**
     * retorna a taxa de acordo com o tipo de pagamento
     * @param string
     *
     * @return float
     */
    public function taxaConversao($valor)
    {
        return $valor >= self::VALOR_CONVERSAO ? 1 : 2;
    }
}
