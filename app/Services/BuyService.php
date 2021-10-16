<?php

namespace App\Services;

use App\Libs\AwesomeApi;

class BuyService
{
    private $awesomeApi;


    public function __construct()
    {
        $this->awesomeApi = new AwesomeApi();
    }


    public function createNew($data)
    {
        $mapTaxes = [
            'boleto' => 1.45,
            'cartao' => 7.63,
        ];

        $paymentTaxe = $mapTaxes[$data['pagamento']];

        $combination =  $data['origemMoeda'].'-'.$data['destinoMoeda'];
        $conversionKey = $data['origemMoeda'].$data['destinoMoeda'];

        $conversion = $this->awesomeApi->converter($combination);

        if(isset($conversion['status']) && $conversion['status'] === 404){
            return redirect()->back()->withErrors('Essa combinação não esta disponivel');
        }

        $originValue = floatval($data['valor']);
        $convertionTaxe = $originValue < 3000 ? 0.02 : 0.01;
        $calcConvertionTaxe = $originValue * $convertionTaxe;
        $calcPaymentTaxe =  ($paymentTaxe * $originValue) / 100;
        $newValue = $originValue - ($calcConvertionTaxe + $calcPaymentTaxe);


        $conversionData = $conversion[$conversionKey];

        $totalConverted = floatval($conversionData['bid']) * $newValue;


        dd($totalConverted, $newValue, $conversionData);


    }
}
