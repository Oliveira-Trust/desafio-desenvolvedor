<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoedaController extends Controller
{

    public function listarMoedas(){
        $endpoint = "https://economia.awesomeapi.com.br/json/available";
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        $moeda = json_decode($response, true);
        foreach($moeda as $code => $name){
            $explodeCode[$code] = explode("-", $code);
            $explodeName[$code] = explode("/", $name);
            
            if($explodeCode[$code][0] == "BRL"){
                $codeAvaliable = $explodeCode[$code][1];
                $nameAvaliable = $explodeName[$code][1];
                $moedaDisponivel[$codeAvaliable] = $nameAvaliable;
            }
        }
        /*ordenando array*/
        asort($moedaDisponivel);
        

        return view('main.index', ['moeda' => $moedaDisponivel,]);

    }

    public function converterMoeda(Request $request)
    {
        try {
            $endpoint = "https://economia.awesomeapi.com.br/json/last/BRL-{$request->moeda}";
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $endpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET'
            ]);
            $response = curl_exec($curl);
            curl_close($curl);
            $converter = json_decode($response, true);
    
            foreach ($converter as $key => $value) {
                if (is_array($value)) {
                    $venda  = $value['ask'];
                    $nome = $value['name'];
                    $code = $value['code'];
                    $codeIn = $value['codein'];
                    $create_date = $value['create_date'];
                }
            }
            
            $valor = $request->valor;
            $quebraNome = explode("/", $nome);
            $nomeCode = $quebraNome[0] . "/" . $code;
            $nomeCodeIn = $quebraNome[1] . "/" . $codeIn;
            $data_cotacao = date("d/m/Y H:i:s",strtotime($create_date));
            
            /*Formatando o dado do campo valor para que seja possivel a realização de operações aritiméticas*/
            $formattedNumber = $request->valor;
            $unformattedNumber = str_replace(['.', ','], ['', '.'], $formattedNumber);

            if($request->metodo_pagamento == "1"){
                $metodo_pagamento = "Cartão de Crédito";
                $taxa_pagamento = 7.63;
                $valor_taxa_pagamento = ($unformattedNumber * $taxa_pagamento)/100;

            }elseif($request->metodo_pagamento == "2"){
                $metodo_pagamento = "Boleto Bancário";
                $taxa_pagamento = 1.45;
                $valor_taxa_pagamento = ($unformattedNumber * $taxa_pagamento)/100;
            }

            if($unformattedNumber < 3000){
                $taxa_conversao = 2;
                $valor_taxa_conversao = ($unformattedNumber * $taxa_conversao)/100;
            }else{
                $taxa_conversao = 1;
                $valor_taxa_conversao = ($unformattedNumber * $taxa_conversao)/100;
            }
            
           
            $valorConvertido = ($unformattedNumber - ($valor_taxa_conversao + $valor_taxa_pagamento)) * $venda;
            $valorConvertido = number_format($valorConvertido,4,",",".");

            return view('main.resultado', [
                'valor' => $valor,  
                'convertido' => $valorConvertido,
                'nomeCode' => $nomeCode,
                'nomeCodeIn' => $nomeCodeIn,
                'pagamento' => $metodo_pagamento,
                'taxa_conversao' => $taxa_conversao,
                'taxa_pagamento' => $taxa_pagamento,
                'data_cotacao' => $data_cotacao,
                'cotacao' => $venda,
            ]);
        } catch (\Exception $e) {
            // Lidar com a exceção
            return "<div class='col-sm-12'><div class='card' style='display:block;color:#fff;background:#D40000;border-radius: 5px; margin-bottom: 0; text-align: center;'>Não foi possível realizar a conversão de &nbsp;<b>{$request->valor} BRL</b> &nbsp;para &nbsp;<b>{$request->moeda}</b>:<br><b>" .$e->getMessage()."</b></div></div>";
        }
    }
    
}
