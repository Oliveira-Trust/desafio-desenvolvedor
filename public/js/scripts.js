import { generateNotification } from './UsefullgenerateNotification.js';
import { currencyConversionData as displayCurrencyConversionData } from './displayCurrencyConversionData.js';
import { removeMaskMoeda } from './rmMask.js';

/**
 * Adiciona um evento de carregamento do conteúdo do DOM
 */
document.addEventListener("DOMContentLoaded", function (e) {

    // Verifica se existe o elemento com id "div-notification"
    if (document.getElementById('div-notification')) {

        // Se existir, esconde os elementos
        document.getElementById('div-notification').style.display = 'none';
        document.getElementById('loading').style.display = 'none';
    }

});

/**
 * Função para buscar dados da API de conversão de moedas
 * @param {object} data - objeto com os dados a serem enviados na requisição
 * @returns {Promise} - retorna uma Promise com o resultado da requisição
 */
const fetchData = (data) => {

    // Endpoint da API
    var endpoint = 'api/convert-currency';

    // Recupera o token CSRF do documento HTML
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    //Exibe o elemento HTML com id "loading"
    document.getElementById('loading').style.display = 'block';

    // Realiza a requisição à API
    return fetch(endpoint, {
        method: 'POST', // Método HTTP

        // Cabeçalhos da requisição
        headers: {
            "Content-Type": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
        },
        body: JSON.stringify(data), // Corpo da requisição (dados a serem enviados)
        dataType: 'json',
    })
        .then(function (response) {

            // Retorna a resposta da requisição como texto
            return response.text();
        }).then(function (result) {

            // Converte o resultado para o formato JSON
            return JSON.parse(result);
        });

}


/**
 * Adiciona um listener de submit ao formulário de conversão de moedas
 */
const form = document.querySelector('.form');
if (form) {
    form.addEventListener('submit', event => {

        // Previne a atualização padrão do formulário
        event.preventDefault();

        // Recupera os dados do formulário
        const data = new FormData(form);
        const type = data.get('currency_type');
        let purchaseAmount = removeMaskMoeda(data.get('purchase_amount'));
        const paymentMethod = data.get('payment_method');
        const emailUser = document.querySelector('#email_user_send_email').value;
        const nameUser = document.querySelector('#name_user_send_email').value;
        const userId = document.querySelector('#user_id').value;
        console.log(purchaseAmount);
        // Realiza a requisição à API com os dados do formulário
        fetchData({ type, purchaseAmount, paymentMethod, emailUser, nameUser, userId })
            .then(response => {

                //Esconde o elemento
                document.getElementById('loading').style.display = 'none';

                // Verifica se houve erro na resposta da requisição
                if (response.data && response.data.hasOwnProperty('erro')) {

                    // Exibe o erro para o usuário
                    alert(response.data.erro);
                } else if (response && response.hasOwnProperty('errors')) {

                    // Exibe uma notificação de erro para o usuário
                    generateNotification(response.errors, 'error');
                } else if (response && response.hasOwnProperty('data')) {

                    // Exibe as informações referente a conversão da moeda
                    displayCurrencyConversionData(response);
                }
            });
    });
}





