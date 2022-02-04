$(document).ready(function(){
    $("#limpar-usuario-tipster").click(function(e){
        $('#form-usuarios-tipsters')[0].reset();
        $('#form-usuarios-tipsters #usuario-tipster-id').val('');
    });
    $("#salvar-usuario-tipster").click(function(e){
        // e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.validacao-usuarios-tipsters').hide();
        $.ajax({
            type:'POST',
            url:rotaSalvarUsuarioTipster,
            data:$('#form-usuarios-tipsters').serialize(),
            dataType: 'json',
            success:function(data){
                // console.log(data.contas);
                atualizarTabelaUsuariosTipsters();
                mensagem = 'Tipster cadastrado com sucesso!';
                if($('#form-usuarios-tipsters #usuario-tipster-id').val() != ''){
                    mensagem = 'Tipster atualizado com sucesso!';
                }
                $('#form-usuarios-tipsters')[0].reset();
                $('#form-usuarios-tipsters #usuario-tipster-id').val('');
                mensagemSucesso(mensagem);
            },
            error: function (retorno) {
                if(retorno.responseJSON.errors.nome != undefined){
                    // console.log(retorno.responseJSON.errors.nome); 
                    $('#nome-validar').html('');
                    $('#nome-validar').html(retorno.responseJSON.errors.nome);
                    $('#nome-validar').show();
                }
                if(retorno.responseJSON.errors.cpf != undefined){
                    // console.log(retorno.responseJSON.errors.cpf); 
                    $('#cpf-validar').html('');
                    $('#cpf-validar').html(retorno.responseJSON.errors.cpf);
                    $('#cpf-validar').show();
                }
                if(retorno.responseJSON.errors.email != undefined){
                    // console.log(retorno.responseJSON.errors.email); 
                    $('#email-validar').html('');
                    $('#email-validar').html(retorno.responseJSON.errors.email);
                    $('#email-validar').show();
                }
                if(retorno.responseJSON.errors.password != undefined){
                    // console.log(retorno.responseJSON.errors.password); 
                    $('#password-validar').html('');
                    $('#password-validar').html(retorno.responseJSON.errors.password);
                    $('#password-validar').show();
                }
            },
        });
    });
});
function atualizarTabelaUsuariosTipsters(){
    $.ajax({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        url: rotaBuscarContas,
        type: 'GET',
        // cache: false,
        // data: { 'userid': userid, '_token': $_token }, //see the $_token
        datatype: 'html',
        beforeSend: function() {
            //something before send
        },
        success: function(data) {
            console.log('success');
            console.log(data);
            $('#card-tabela-usuarios-tipsters').html(data.html);
            reiniciarDataTable();
        },
        error: function(xhr,textStatus,thrownError) {
        }
    });
}

function montarEditar(id,nome,cpf, email){
    $('#form-usuarios-tipsters')[0].reset();
    $('#form-usuarios-tipsters #usuario-tipster-id').val(id);
    $('#form-usuarios-tipsters #usuario-tipster-nome').val(nome);
    $('#form-usuarios-tipsters #usuario-tipster-cpf').val(cpf);
    $('#form-usuarios-tipsters #usuario-tipster-email').val(email);
}
