$(document).ready(function () {
    $('.modal').modal();
    $('#valor_real').mask('000.000,00', { reverse: true });

    // Função para consultar e inserir as cotações fixas da tela de inicio
    cotacao();

    // Função para validar se o usuário está ou não logado no sistema
    // Idealmente essa consulta deve ser feita no backend e a gestão de permissões devem ser feitas por midlewares
    validarSessao();

    // Apenas esconde os botões de login e cadastro caso o usuário já tenha se autenticado
    if (localStorage.getItem('login') != undefined) {
        $('#btn_modal1').hide();
        $('#btn_modal2').hide();
    }

});

window.setInterval(function () { cotacao(); }, 30000);

$(document).on("click", "#btn_login", function () {
    login();
});


$(document).on("click", "#btn_cadastro", function () {
    cadastro();
});


$(document).on("click", "#btn_convert", function () {
    $('msg_retorno').html('');
    // Recurso primitivo para evitar usuários não autenticados de realizar a conversão
    // Idealmente isso deve ser feito no backend através de midlewares
    if (localStorage.getItem('login') == undefined) {
        alert('Faça login para realizar as cotações!')
        return
    }

    // Realiza os calculos de conversão
    converter();

    // Função para validar se o usuário está ou não logado no sistema
    // Idealmente essa consulta deve ser feita no backend e a gestão de permissões devem ser feitas por midlewares
    validarSessao();
});

