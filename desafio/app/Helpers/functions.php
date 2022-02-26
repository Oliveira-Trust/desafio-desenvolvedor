<?php

function removeDecimal($value) {
    return (int)str_replace('.', '', strstr($value, ',', true));
}

function acronym($currency) {
    switch($currency) {
        case 'BRL':
            return 'R$';
            break;
        case 'USD':
            return '$';
            break;
        case'EUR':
            return '€';
            break;
        default:
            return 'R$';
    };
}

function money($value, string $currency = 'BRL') {
    if ($currency == 'BRL')
        return 'R$' . number_format($value, 2, ',', '.');

    if ($currency == 'USD')
        return '$' . number_format($value, 2, '.', ',');

    if ($currency == 'EUR')
        return '€' . number_format($value, 2, '', ',');
}