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
        const purchaseAmount = data.get('purchase_amount');
        const paymentMethod = data.get('payment_method');
        const emailUser = document.querySelector('#email_user_send_email').value;
        const nameUser = document.querySelector('#name_user_send_email').value;
        const userId = document.querySelector('#user_id').value;

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


/**
 * Função que exibe os dados da conversão de moedas
 * @param {Object} response - Resposta da API com os dados da conversão
 */
const displayCurrencyConversionData = (response) => {

    // Reseta o formulário
    form.reset();

    // Variável que armazena a mensagem a ser exibida
    var message = `Moeda de origem: ${response.data.origin_currency}<br>Moeda de destino: ${response.data.destination_currency}<br>Valor para conversão: ${response.data.value_conversation.toFixed(2)}<br>Forma de pagamento: ${response.data.form_payment}<br>Valor da "Moeda de destino" usado para conversão: ${response.data.dest_currency_conv}<br>Valor comprado em "Moeda de destino": ${response.data.purchased_amount_in.toFixed(2)}<br>Taxa de pagamento: ${response.data.pay_rate.toFixed(2)}<br>Taxa de conversão: ${response.data.conversion_rate.toFixed(2)}<br>Valor utilizado para conversão descontando as taxas: ${response.data.amount_used_conv.toFixed(2)}`;

    // Chama a função "generateNotification" para exibir a notificação
    generateNotification(false, 'success', message);

}


/**
 * Função que gera uma notificação na página
 * @param {Object} obj - Objeto a ser utilizado na geração da mensagem de notificação
 * @param {String} status - Status da notificação (sucesso ou erro)
 * @param {String} message - Mensagem da notificação (opcional)
 */
function generateNotification(obj, status, message = false) {

    // Exibe o elemento com id "div-notification" na página
    document.getElementById('div-notification').style.display = 'block';

    // Recupera o elemento com id "msg"
    var msg = document.getElementById('msg');

    // Variável que armazena a mensagem de email enviado
    var email = '<div style="padding: 20px" >A cotação foi enviada pra o email <b>' + document.querySelector('#email_user_send_email').value + '</b></div>';

    // Se o status não for "success" e não houver uma mensagem especificada
    if (status != 'success' && !message) {

        // Gera a mensagem a partir do objeto
        message = createMessage(obj);

        // Define o status como "danger"
        status = 'danger';

        // Limpa a mensagem de email enviado
        email = '';
    }

    // Atribui o HTML da notificação ao elemento "msg"
    msg.innerHTML = '<div id="msg" class="alert alert-' + status + ' alert-dismissible fade show" role="alert">' + email + message + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

}


/**
 * Cria uma mensagem baseada em um objeto passado como parâmetro
 * @param {Object} obj - objeto com informações para geração da mensagem
 * @returns {String} mensagem gerada a partir do objeto
 */
function createMessage(obj) {
    // Inicializa a variável que armazenará a mensagem
    var message = '';

    // Percorre cada propriedade do objeto
    Object.keys(obj).forEach(function (item) {

        // Altera a aparência do elemento HTML com o id correspondente a propriedade do objeto
        document.getElementById(item).style.cssText = 'border: #FF0000 solid 1px !important;';

        // Percorre cada item do array na propriedade do objeto
        obj[item].forEach((itemArray) => {
            
            // Adiciona o item do array na mensagem
            message += itemArray + "<br>";
        });
    })

    // Retorna a mensagem gerada
    return message;
}

/**
 * Limpa a borda de um elemento HTML
 * @param {HTMLElement} element - Elemento HTML que terá a borda limpa
 */
function clearBorder(element) {
    element.style.cssText = 'border: #dee2e6 solid 1px !important';
}