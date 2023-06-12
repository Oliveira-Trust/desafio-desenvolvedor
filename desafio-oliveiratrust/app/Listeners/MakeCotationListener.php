<?php

namespace App\Listeners;

use App\Services\EconomiaApiService;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MakeCotationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $economiaApiService;

    public function __construct(EconomiaApiService $economiaApiService)
    {
        $this->economiaApiService = $economiaApiService;
    }


    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($cotation)
    {
        $tax = $this->economiaApiService->getTaxConversion($cotation->origin_currency, $cotation->destination_currency);
        $objectVars = get_object_vars($tax); // o nome do objeto sempre muda, de acordo com a conversão
        $valueDestCurrency = 0;

        foreach ($objectVars as $key => $value) {
            if ($tax->$key->high) {
                $valueDestCurrency = (float)$tax->$key->high;
            } else {
                throw new Exception('Não houve retorno da API para consultar o valor de conversão');
            }
        }
        $totalConvert = $cotation->conversion_amount * $valueDestCurrency;

        
        $cotation->currency_rate = $valueDestCurrency; // valor da moeda de destino
        $cotation->purchase_amount = $totalConvert; // valor comprado na moeda de destino
        $cotation->total_purchase_amount = $totalConvert; 



        dd($valueDestCurrency, $totalConvert);

        dd($totalConvert);

        /*
            "origin_currency" => "BRL"
            "destination_currency" => "ARS"
            "conversion_amount" => "15000"
            "payment_method" => "boleto"
            "updated_at" => "2023-06-11 14:33:49"
            "created_at" => "2023-06-11 14:33:49"
            "id" => 19

            'origin_currency',          - Moeda de Origem
            'destination_currency',     - Moeda de Destino
            'conversion_amount',        - Valor para Conversão
            'payment_method',           - Forma de Pagamento
            'currency_rate',            - Valor da Moeda
            'purchase_amount',          - Valor comprado na Moeda
            'total_purchase_amount',    - 
            'payment_fee',              - Taxa de pagamento por ser boleto ou cartão
            'conversion_fee',           - taxa de conversão pelo valor (ver regra)
            'amount_minus_fee',         - valor para conversao - Taxa de pagamento - taxa de conversão
        */


        dd($cotation->origin_currency, $cotation->destination_currency);
    }
}
