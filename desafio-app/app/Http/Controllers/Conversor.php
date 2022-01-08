<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Conversor extends Controller
{
    public function store($moeda, $valor, $pagamento)
    {
        $valorMoeda = 0;
        $moedaDestino = "";
        $valor = (float)$valor;

        // Buscando dados da api.
        $url = "https://economia.awesomeapi.com.br/last/$moeda-BRL";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        $dados = json_decode(curl_exec($ch));

        // Separando os dados que serão usados no cálculo.
        foreach ($dados as $key) {
            $valorMoeda = (float)$key->bid;
            $moedaDestino = $key->code;
        }

        switch ($pagamento) {
            case '1':
                $taxaPg = $valor * 0.0145; // 1,45% do valor para conversão.
                $formaPg = 'Boleto';
                break;

            case '2':
                $taxaPg = $valor * 0.0763; // 7,63% do valor para conversão.
                $formaPg = 'Cartão de crédito';
                break;
        }

        if($valor < 3000.00){
            $taxaConversao = $valor * 0.02; // 2% do valor para conversão.
        }else{
            $taxaConversao = $valor * 0.01; // 1% do valor para conversão.
        }

        $descontoValorConversao = $valor - $taxaPg - $taxaConversao; // Desconta as taxas do valor para conversão.
        $valorConvertido = $descontoValorConversao / $valorMoeda; // Faz a conversão do valor.

        return response()->json([
            'taxaPg'             => $taxaPg,
            'formaPg'            => $formaPg,
            'taxaConversao'      => $taxaConversao,
            'valorComDesconto'   => $descontoValorConversao,
            'valorConvertido'    => $valorConvertido,
            'moedaDestino'       => $moedaDestino,
            'valorParaConversao' => $valor,
            'valorMoeda'         => $valorMoeda   
        ]);
    }
}
