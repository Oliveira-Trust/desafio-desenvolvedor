/**
 * Função que gera uma notificação na página
 * @param {Object} obj - Objeto a ser utilizado na geração da mensagem de notificação
 * @param {String} status - Status da notificação (sucesso ou erro)
 * @param {String} message - Mensagem da notificação (opcional)
 */
export const generateNotification = (obj, status, message = false) => {

    // Exibe o elemento com id "div-notification" na página
    document.getElementById('div-notification').style.display = 'block';

    // Recupera o elemento com id "msg"
    const msg = document.getElementById('msg');

    // Variável que armazena a mensagem de email enviado
    let email = '<div style="padding: 20px" >A cotação foi enviada pra o email <b>' + document.querySelector('#email_user_send_email').value + '</b></div>';

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
const createMessage = (obj) => {
    // Inicializa a variável que armazenará a mensagem
    let message = '';

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