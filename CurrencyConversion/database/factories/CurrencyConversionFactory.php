<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyConversionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        // Valor entre R$ 1000 e R$ 100.000
        $Money              = rand(1000, 100000);

        // Taxa da Moeda
        $tax_currency       = rand(9, 70) /10;

        // Se o valor for menor que 3 mil coloca tax de 2 %
        if($Money < 3000) $tax_conversion = 2; else  $tax_conversion = 1;
        // Calcura a taxa do valor
        $tax_conversion = round($Money * $tax_conversion  / 100,  2);
    

        // Escolhe um meio de pagamento CREDIT_CARD ou BANK_SLIP
        $payment_method     = [['type' => 'CREDIT_CARD', 'tax' => 1.45],  ['type' => 'BANK_SLIP', 'tax' => 7.63]];
        $payment_method     = $payment_method[rand(0,1)];

        // Calcula a taxa do meio de pagamento
        $tax_payment_method = round($Money * $payment_method['tax']  / 100,  2);

        // Atualiza o valor de acordo com as taxas aplicadas
        $updated_value      =  $Money - ($tax_conversion  + $tax_payment_method);

        // Faz a conversao do valor atualizado para a nova moeda
        $converted_value    =  $updated_value  /  $tax_currency;
        
        return [
            'origin_currency' => 1,
            'cur_id' => rand(1,3),
            'origin_value'  => $Money,
            'tax_currency' => $tax_currency,
            'tax_payment_method' => $tax_payment_method,
            'tax_conversion' => $tax_conversion,
            'converted_value' => $converted_value,
            'updated_value' => $updated_value,
            'payment_method' => $payment_method['type'],
            'usu_id' => rand(1,10),
        ];
    }

}
