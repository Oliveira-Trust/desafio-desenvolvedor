<?php

/**
 * Função que retorna falso para valores menor que min_amount ou maior que max_amount
 * De acordo com valores definidos no painel de controle
 * @param float $value
 * 
 * @return boolean
 */

function validValue($value) 
{
    if ($value < floatval(rates()->min_amount) || $value > floatval(rates()->max_amount)) {
        return false;
    } else {
        return true;
    }
}

/**
 * Função que retorna a taxa de conversão de acordo com valores definidos no painel de controle
 * 
 * @param float $value
 * 
 * @return float
 */


function rate($value) {

    if ($value < rates()->target_amount){
        return floatval(rates()->rate_max);
    } else {
        return floatval(rates()->rate_min);
    }
}

/**
 * Função que retorna a taxa de pagamento sendo 1,45% (default) para pagamento no boleto ou 7,63 (default) 
 * para pagamento no cartão de crédito
 * 
 * @param float $value
 * 
 * @return float
 */


function paymentRate($paymentType) {

    if ($paymentType == 'Boleto'){
        return floatval(rates()->rate_bankslips);
    } 
    if ($paymentType == 'Cartao Credito') {
        return floatval(rates()->rate_credit_card);
    }
}

/**
 * Função que retorna as taxas definidas no painel de controle
 * @return collection 
 */

function rates(){
    return \App\Models\Rate::first();
}