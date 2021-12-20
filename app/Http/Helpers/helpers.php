<?php
/*Coloca virgula e zero em valores ex: 1.9 = 1,90*/
function pv($valor)
{
    return number_format($valor,2,",",".");
}

/*Coloca ponto e zero em valores ex: 1,9 = 1.90*/
function pp($valor){
	$final = str_replace(",",".",$valor);
	return $final;
}

// Formata valor do dinheiro baseado na Currency Code ex: USD, BRL, JPY
function currencyFormat($currency_code, $v) {
	$formatter = new NumberFormatter('en_US', NumberFormatter::CURRENCY);
	$formatter->setPattern(str_replace('¤#',"¤\xC2\xA0#", $formatter->getPattern()));
	return $formatter->formatCurrency($v, $currency_code);
}


