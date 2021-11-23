<?php

namespace App\Http\Controllers;

use App\Business\ConversionBusiness;
use Illuminate\Http\Request;

class ConversionController extends Controller
{
    /**
     * @var ConversionBusiness
     */
    private $conversionBusiness;

    public function __construct(ConversionBusiness $conversionBusiness)
    {
        $this->conversionBusiness = $conversionBusiness;
    }

    public function showIndex(){
        return view('conversion.index');
    }

    public function conversion(Request $request)
    {
        $moedaDestino = $request->get('moedaDestino');
        $arrMoedaDestino = $this->getMoedaSelecionada($moedaDestino);
        $valor        = $request->get('valor');
        $formaPagto   = $request->get('formaPagto');
        $tax = '';
        $taxConversion = '';
        $response = [];

        $moedaDestino = str_replace('-', '', $moedaDestino);

        if ($valor < 1000 || $valor > 100000){
            $response['errorMessage'] = 'Informe um valor entre R$1.000,00 e R$100.000,00';
            return back()->with($response)->withInput($request->all());
        }

        if ($valor < 3000){
            $taxConversion = ($valor * 2)/100;
        } else {
            $taxConversion = ($valor * 1)/100;
        }

        if ($formaPagto == 'boleto'){
            $tax = ($valor * 1.45)/100;
        } elseif ($formaPagto == 'credito'){
            $tax = ($valor * 7.63)/100;
        }

        $data = [
            'moedaDestino' => $arrMoedaDestino[$moedaDestino]['name'],
            'valor' =>  'R$ '.number_format($valor, 2, ',', '.'),
            'formaPagto' => $formaPagto,
            'valorMoedaDestino' => 'R$ '.number_format(round($arrMoedaDestino[$moedaDestino]['bid'],2), 2, ',', '.'),
            'valorComprado' => '$ '.number_format(round(($valor -  $tax - $taxConversion)/$arrMoedaDestino[$moedaDestino]['bid'],2), 2, ',', '.'),
            'taxaPagto' => 'R$ '.number_format($tax, 2, ',', '.'),
            'taxConversion' => 'R$ '.number_format($taxConversion, 2, ',', '.'),
            'valorTotalDescontado' => 'R$ '.number_format($valor - $tax - $taxConversion, 2, ',', '.')
        ];

        return view('conversion/index', ['data' => $data]);
    }

    public function getMoedaSelecionada($moedaDestino)
    {
        return $this->conversionBusiness->getMoedaSelecionada($moedaDestino);
    }
}
