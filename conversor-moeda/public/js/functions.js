function formatDate(date) {
    date2 = date.split(' ');
    return date2[0].split('-').reverse().join('/');
}

function formatPrice(number, moeda) {

    number = parseFloat(parseFloat(number).toFixed(2));
    switch (moeda) {
        case 'USD':
            return new Intl.NumberFormat("en-IN", {
                style: "currency",
                currency: "USD",
            }).format(number);
            break;

        case 'EUR':
            return new Intl.NumberFormat("en-IN", {
                style: "currency",
                currency: "EUR",
            }).format(number);
            break;
        case 'GBP':
            return new Intl.NumberFormat("en-IN", {
                style: "currency",
                currency: "GBP",
            }).format(number);
            break;

        default:
            return new Intl.NumberFormat("pt-BR", {
                style: "currency",
                currency: "BRL",
            }).format(number);
            break;
    }


}


// Função que consulta as cotações fixas da tela inicial e atuzaliza a cada 30 segundos
function cotacao() {
    $.ajax({
        type: "GET",
        url: 'https://economia.awesomeapi.com.br/last/USD-BRL,EUR-BRL,GBP-BRL',
        success: function (data) {
            $('#stats').html('').fadeOut('fast');
            $.each(data, function (index, value) {
                let name = value.name.split('/');
                $('.moedas_diponiveis').append(`<option value="" >${name[0]}</option>`);
                let signal = value.pctChange > 0 ? 'keyboard_arrow_up' : 'keyboard_arrow_down'
                $('#stats').append(`
                    <div class="col l4 m6 s12">
                    <div class="card">
                    <div class="card-metric">
                    <div class="col s12">${value.code} (${name[0]})</div>
                    <div class="col s6">Alta</div>
                    <div class="col s6">${formatPrice(value.high)}</div>
                    <div class="col s6">Baixa</div>
                    <div class="col s6">${formatPrice(value.low)}</div>
                    <div class="col s6">Valor atual</div>
                    <div class="col s6">${formatPrice(value.bid)}</div>
                    <div class="card-metric-change decrease ${signal}">  <i class="material-icons left">${signal}</i> ${value.pctChange}% </div>
                    </div>
                    </div>
                    </div>`
                ).fadeIn('fast');
            });
            $('select').formSelect();
            $('.moedas_diponiveis').removeClass('moedas_diponiveis');
        }
    });
}


function retornoOK(data, key) {
    let html = montarHTML(data);
    $(key).append(html);

}


// Monta o HTML do retorno das conversões, tanto o histórico quanto o a conversão realizada;
function montarHTML(data) {
    let html = '';
    $.each(data, function (index, value) {
        html += `<div class="div-ret"><ul class="collection">
        <li class="collection-item">Data:<span class="secondary-content">${formatDate(value.created_at)} </span></li>
        <li class="collection-item">Valor em Reais:<span class="secondary-content">${formatPrice(value.valor_real)} </span></li>
        <li class="collection-item">Valor da moeda a ser convertida (${value.moeda}):<span class="secondary-content">${formatPrice(value.valor_moeda)} </span></li>
        <li class="collection-item">Valor da taxa de conversão (${value.taxa_conversao}%):<span class="secondary-content">${formatPrice(value.valor_taxa_conversao)} </span></li>
        <li class="collection-item">Forma de pagamento:<span class="secondary-content">${$("#forma_pgto option:selected").html()} </span></li>
        <li class="collection-item">Valor da taxa de pagamento (${value.taxa_pgto}%):<span class="secondary-content">${formatPrice(value.valor_taxa_pgto)} </span></li>
        <li class="collection-item">Valor a ser convertido:<span class="secondary-content">${formatPrice(value.valor_para_conversao)} </span></li>
        <li class="collection-item">Valor convertido (${value.moeda}):<span class="secondary-content">${formatPrice(value.valor_convertido, value.moeda)} </span></li>
        </ul></div>`;
    });
    return html;
}

// Função inserir o id de autenticação e criar uma 'sessão'
// Idealmente deveria ser feito no backend
function sessao(id) {
    localStorage.setItem('login', id);
}

// Função para validar a sessão e consultar o histórico de conversões caso hajam
function validarSessao() {
    let id = localStorage.getItem('login');
    if (typeof id != undefined) {
        var fd = new FormData();
        fd.append('id', id);

        $.ajax({
            type: "POST",
            url: '/consultarHistorico',
            data: fd,
            contentType: false,
            processData: false,
            headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
            success: function (data) {
                retornoOK(data.msg, '#historico');
            }
        });
    }
}

// Função para login de usuários
function login() {
    var email = $('#email_login').val();
    var senha = $('#senha_login').val();

    if (!email || !senha) {
        alert('Usuário e senha são obrigatórios!');
        return;
    }

    var fd = new FormData();
    fd.append('email', email);
    fd.append('senha', senha);

    $.ajax({
        type: "POST",
        url: '/loginAcesso',
        data: fd,
        contentType: false,
        processData: false,
        headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
        success: function (data) {

            if (data.error) {
                alert(data.msg)
                return
            } else {
                sessao(data.msg.id);
                retornoOK(data.msg.historico,'#historico');
                $('#btn_modal1').hide();
                $('#btn_modal2').hide();        
            }

        }
    });

}

// Função para cadastro de usuários
function cadastro() {
    var nome = $('#nome_cadastro').val();
    var email = $('#email_cadastro').val();
    var senha = $('#senha_cadastro').val();

    if (!email || !senha || !nome) {
        alert('Todos os campos são obrigatórios!');
        return;
    }

    var fd = new FormData();
    fd.append('nome', nome);
    fd.append('email', email);
    fd.append('senha', senha);

    $.ajax({
        type: "POST",
        url: '/loginCadastro',
        data: fd,
        contentType: false,
        processData: false,
        headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
        success: function (data) {
            if (data.error) {
                alert(data.msg)
                return
            } else {
                alert('Cadastro realizado com sucesso.')
                sessao(data.msg);
                $('#btn_modal1').hide();
                $('#btn_modal2').hide();
        
            }
        }
    });

}

// Função que faz a consulta no backend para a conversão dos valores e mostra o resultado na tela
function converter() {
    $('#btn_convert').prop("disabled", true);
    $('#ret').html('');

    let valor_real = $('#valor_real').val();
    let moeda = $("#moedas_conversao option:selected").val();
    let forma_pgto = $("#forma_pgto option:selected").val();

    let fd = new FormData();
    fd.append('valor_real', valor_real);
    fd.append('moeda', moeda);
    fd.append('forma_pgto', forma_pgto);
    fd.append('user_id', localStorage.getItem('login'));

    $.ajax({
        type: "POST",
        url: '/converterValores',
        data: fd,
        contentType: false,
        processData: false,
        headers: { 'X-CSRF-TOKEN': $('input[name="_token"]').val() },
        success: function (data) {
            $('#btn_convert').prop("disabled", false);

            switch (data.error) {
                case 'error':
                    $('#msg_retorno').removeClass('displayNone').html(data.msg);
                    break;
                case 'warning':
                    $('#msg_retorno').removeClass('displayNone').html(data.msg);
                    break;
                default:
                    $('#msg_retorno').addClass('displayNone');
                    retornoOK(data, '#ret');
                    break;
            }

        }
    });
}





