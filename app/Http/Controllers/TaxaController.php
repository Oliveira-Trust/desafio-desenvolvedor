<?php

namespace App\Http\Controllers;

use App\Models\TaxaConversao;
use App\Models\TaxaFormaPagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaxaController extends Controller
{
     /**
     *
     * Cadastra uma nova taxa de conversão a ser aplicada ao valor para conversão
     * sendo que a taxaMaior será para valores menores que a taxa de referência
     * e taxaMenor será para valores maiores que a taxa de referência
     * 
     * @param decimal valorReferencia Exemplo: 3200 
     * @param decimal taxaMaior Exemplo:1200
     * @param decimal taxaMaior Exemplo:4000
     *    
     * @return json informando que o cadastro foi realizado com sucesso
     */

    public function cadastrarTaxaConversao(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'valorReferencia' => 'required',
            'taxaMaior' => 'required',
            'taxaMaior' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 403);
        }

        $taxaConversao = TaxaConversao::create([
            'valor_referencia' => $request->valorReferencia,
            'taxa_maior' => $request->taxaMaior,
            'taxa_menor' => $request->taxaMenor
        ]);
     
        return response()->json(['message' => "Taxa de conversão cadastrada com sucesso", 'status' => 200], 200);
    }


         /**
     *
     * Cadastra uma nova taxa de forma de pagamento (boleto ou cartão de crédito) a ser aplicada ao valor para conversão
     * sendo que a taxaMaior será para valores menores que a taxa de referência
     * e taxaMenor será para valores maiores que a taxa de referência
     * 
     * @param integer tipoFormaPagamento Exemplo: 1(boleto), 2(cartão de crédito)
     * @param decimal taxa Exemplo:2,2
     *    
     * @return json Informando que o cadastro foi realizado com sucesso
     */

    public function cadastrarTaxaFormaPagamento(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipoFormaPagamento' => 'required',
            'taxa' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 403);
        }
        switch ($request->tipoFormaPagamento) {
            case 1:
                $descricao = "Boleto";
                break;

            case 2:
                $descricao = "Cartão de Crédito";
                break;
        }


        $taxaFormaPagamento = TaxaFormaPagamento::create([
            'tipo_forma_pagamento' => $request->tipoFormaPagamento,
            'descricao' => $descricao,
            'taxa' => $request->taxa
        ]);
        return response()->json(['message' => "Taxa de forma de pagamento cadastrado com sucesso", 'status' => 200], 200);
    }
}
