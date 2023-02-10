/**
 * Função para formatar o número em uma representação de moeda
 * @param {Number} numero - Número a ser formatado
 * @param {String} code - Código da moeda (opcional)
 * @param {Boolean} toFixed - Indica se o número deve ser arredondado (opcional)
 * @returns {String} Número formatado como moeda
 */
export const currencyFormat = (numero, code = false, toFixed = true) => {

    // Define o símbolo da moeda como 'R$' por padrão
    let cipher = 'R$';

    // Verifica se o código é USD ou EUR e muda o símbolo da moeda de acordo
    if (code == 'USD') {
        cipher = '$';
    } else if (code == 'EUR') {
        cipher = '€';
    }

    // Verifica se o número deve ser arredondado
    if (toFixed) {
        numero = numero.toFixed(2).split('.');
    } else {
        numero = numero.split('.');
    }

    // Adiciona o símbolo da moeda e formata a parte inteira do número com ponto de milhar
    numero[0] = cipher + " " + numero[0].split(/(?=(?:...)*$)/).join('.');
    return numero.join(',');
}