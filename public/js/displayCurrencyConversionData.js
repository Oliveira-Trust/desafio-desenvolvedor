import { generateNotification } from './UsefullgenerateNotification.js';
import { currencyFormat } from './format.js';

/**
 * Função que exibe os dados da conversão de moedas
 * @param {Object} response - Resposta da API com os dados da conversão
 */

export const currencyConversionData = (response) => {

    const form = document.querySelector('.form');

    // Reseta o formulário
    form.reset();

    // Variável que armazena a mensagem a ser exibida
    var message = `Moeda de origem: ${response.data.origin_currency}<br>Moeda de destino: ${response.data.destination_currency}<br>Valor para conversão: ${currencyFormat(response.data.value_conversation)}<br>Forma de pagamento: ${response.data.form_payment}<br>Valor da "Moeda de destino" usado para conversão: ${currencyFormat(response.data.dest_currency_conv, response.data.destination_currency, false)}<br>Valor comprado em "Moeda de destino": ${currencyFormat(response.data.purchased_amount_in, response.data.destination_currency)}<br>Taxa de pagamento: ${currencyFormat(response.data.pay_rate)}<br>Taxa de conversão: ${currencyFormat(response.data.conversion_rate)}<br>Valor utilizado para conversão descontando as taxas: ${currencyFormat(response.data.amount_used_conv)}`;

    // Chama a função "generateNotification" para exibir a notificação
    generateNotification(false, 'success', message);
}