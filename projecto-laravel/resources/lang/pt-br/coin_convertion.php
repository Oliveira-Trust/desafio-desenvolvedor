<?php

return [

    // Format Date
    'datetime_format' => 'd/m/Y H\hi',

    'title-historic' => 'Histórico de conversões',

    // Required
    'currency.required' => 'O campo "Moeda a Comprar" é obrigatório',
    'convertion_value.required' => 'O campo "Valor a ser Convertido" é obrigatório',
    'payment_method.required' => 'O campo "Forma de Pagamento" é obrigatório',

    // In
    'currency.in' => 'Você selecionou uma "Moeda" inválida',
    'payment_method.in' => 'Você selecionou uma "Forma de Pagamento" inválida',

    // Lt
    'convertion_value.lt' => 'O "Valor de Compra" precisa ser menor que :value',

    // Gt
    'convertion_value.gt' => 'O "Valor de Compra" precisa ser maior que :value',

    // Errors Messages
    'paymentFeeError' => 'Não foi possível configurar o valor da taxa de pagamento',

    'convertionFeeError' => 'Não foi possível configurar o valor da taxa de pagamento',

    'success.array.currency_origin' => 'Moeda de origem: ',
    'success.array.currency_destin' => 'Moeda de destino: ',
    'success.array.conversion_value' => 'Valor para conversão: R$ ',
    'success.array.payment_method' => 'Forma de pagamento: ',
    'success.array.current_quote_destin' => 'Valor da "Moeda de destino" usado para conversão: $ ',
    'success.array.purchased_total' => 'Valor comprado em "Moeda de destino": $ ',
    'success.array.payment_fee' => 'Taxa de pagamento: R$ ',
    'success.array.convertion_fee' => 'Taxa de conversão: R$ ',
    'success.array.used_value_currency_conversion' => 'Valor utilizado para conversão descontando as taxas: R$ ',

    'success.array.payment_method.credit-card' => 'Cartão de Crédito',
    'success.array.payment_method.debit-card' => 'Cartão de Débito',
    'success.array.payment_method.ticket' => 'Boleto',

    'error.unauthenticated' => 'Sua sessão expirou. Atualize a página e faça o login novamente',

    'table.head.origin' => 'Moeda de Origem',
    'table.head.destin' => 'Moeda de Destino',
    'table.head.payment' => 'Forma Pagto',
    'table.head.value_to_convert' => 'Valor para Conversão',
    'table.head.purchased_total' => 'Total Convertido',
    'table.head.date' => 'Data',

    'table.empty' => 'Lista vazia',
    'table.error' => 'Ocorreu um erro ao tentar atualizar o histórico',

];
