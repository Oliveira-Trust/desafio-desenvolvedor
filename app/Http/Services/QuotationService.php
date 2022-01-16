<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Http\Request;

class QuotationService
{
    public function quotation($data) {
        $response = json_decode(curlGET('https://economia.awesomeapi.com.br/json/last/BRL-' . $data['finalCoin'],[]), true);

        if(!isset($response['BRL'.$data['finalCoin']])){
            throw new Exception($response['message'], $response['status']);
        }

        $quotation = $response['BRL'.$data['finalCoin']];

        $valueFinalCoin = floatval($quotation['bid']);
        $conversionRate = $data['conversionValue'] < 3000 ? 2 : 1;
        $paymentRate = $data['paymentType'] == "Boleto" ? 1.45 : 7.63;
        $valeuConversionRate = round(($data['conversionValue'] * $conversionRate) / 100,2);
        $valeuPaymentRate = round(($data['conversionValue'] * $paymentRate) / 100,2);
        $valueWithDiscount = $data['conversionValue'] - $valeuPaymentRate - $valeuConversionRate;

        $conversionFinal = round($valueWithDiscount * $valueFinalCoin,2);
        $valor = round($valueWithDiscount / $conversionFinal,2);

        return [
            "Moeda de origem"                                     => "BRL",
            "Moeda de destino"                                    => $data['finalCoin'],
            "Valor para conversão"                                => formatBRL($data['conversionValue']),
            "Forma de pagamento"                                  => $data['paymentType'],
            "Valor da 'Moeda de destino' usado para conversão"    => formatMoney($valor),
            "Valor comprado em 'Moeda de destino'"                => formatMoney($conversionFinal),
            "Taxa de pagamento"                                   => formatBRL($valeuPaymentRate),
            "Taxa de conversão"                                   => formatBRL($valeuConversionRate),
            "Valor utilizado para conversão descontando as taxas" => formatBRL($valueWithDiscount)
        ];
    }

    public function getAllCoin() {
        $list = json_decode(curlGET('https://economia.awesomeapi.com.br/json/available',[]), true);
        $final = [];

        foreach($list as $coin => $name){
            $prefix = explode("-", $coin);

            if($prefix[0] == 'BRL'){
                array_push($final, $prefix[1]);
            }
        }

        return $final;
    }

    public function getPaymentType() {
        return [
            'Boleto' => 1.45,
            'Cartão de Crédito' => 7.63
        ];
    }
}
