<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class CotacaoController extends Controller
{

    protected $taxa;

    public const USD = 'USD';
    
    public const BRL = 'BRL';


    public function __construct() 
    {
        $this->taxa = new Taxas;
    }

  
    public function get(ApiController $cotacao) 
    {
        $cotacao = $cotacao->getQuotesCoins(self::USD, self::BRL);
        $cotacao = $cotacao['USDBRL'] ?? [];

        return view('app.admin', ['cotacao' => $cotacao ]);
    }

    public function toConvert(Request $request) 
    {

       $moeda= str_replace(",", ".", $request->moeda_origem);
      
       $moeda_origem  = str_replace(",", ".", $request->moeda_origem);
    
       $moeda_destino = $request->moeda_destino;
       $total_conversao = (float) $request->valor_conversao;
       
       $tipo_pagamento = $request->formato_pagamento;
       
       // aborta a execução caso o saldo  seja menor que 1000,00 ou maior 100.000,00
       $this->taxa->stopRunning($total_conversao);
       
       $moeda_origem = (float) $moeda_origem;

       $valor_compra = ($total_conversao / $moeda_origem);

       $pagamento = $this->taxa->payment($tipo_pagamento);
       $percetual_compra = $this->taxa->percentageFeeWithOneOrTwo($total_conversao);
       
       // taxa de pagamento
       $taxa_pagamento = ($total_conversao * $pagamento) / 100;
       
       // taxa de conversão
       $taxa_conversao = ($total_conversao * $percetual_compra) / 100;

       $saldo_com_descontos_taxas = $total_conversao - $taxa_conversao - $taxa_pagamento;

       $dataset = [
          'taxa_conversao' => $taxa_conversao,
          'taxa_pagamento' => $taxa_pagamento,
          'moeda_destino' => $moeda_origem,
          'moedas_comprada' => $valor_compra,
          'total_conversao' =>  $saldo_com_descontos_taxas
       ];

       foreach ($dataset as $key => $value ) {
           $dataset[$key] = number_format($value, 2, ',', '.'); 
       }


    //    echo '<pre>';
    //    var_dump($dataset);

    //    die;
    //    print 'Taxa Conversão: ' . number_format($taxa_conversao, 2, ',', '.')  . '<br>';
    //    print 'Taxa Pagamento: ' . number_format($taxa_pagamento, 2, ',', '.') . '<br>';

    //    print 'Valor da moeda de destino: ' . number_format($moeda, 2, ',', '.')  . '<br>';
    //    print 'Valor comprado: ' .  number_format($valor_compra, 2, ',', '.')   . '<br>';
    //    print 'Taxa da conversão descontado: ' . number_format($saldo_com_descontos_taxas , 2, ',', '.')   . '<br>';
    //    die;


       
       // print $saldo_dollar;

       return view('app.admin', $dataset);
       
       
    }
}
