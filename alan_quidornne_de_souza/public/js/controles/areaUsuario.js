function abrirModalAlterarDadosCadastrais(){
  var elModal = $('#alterarDadosCadastraisModal');
  elModal.find('input, textarea, select').removeAttr('disabled');
  limparModalAlterarDadosCadastraisModal();
  $('#btnAlterarDadosCadastrais').removeAttr('disabled');
  $('#alterarDadosCadastraisModal').modal('show');
}

function limparModalAlterarDadosCadastraisModal(){
  $('#formAlterarDadosCadastrais label.error').remove();
  $('#formAlterarDadosCadastrais .error').removeClass('error');
  $('#msgErroModal_1').hide();
}

$(document).ready(function(){
  $.validator.messages.required = "Este campo é obrigátório.";
  $.validator.messages.email = "E-mail inválido.";
  $.validator.messages.equalTo = "As senhas não conferem.";

  $("#formAlterarDadosCadastrais").validate({
      invalidHandler: function(e, validator) {
        var errors = validator.numberOfInvalids();
        if (errors) {
            $("#msgErroModal_1 p").html("Existem erros no formulário.");
            $("#msgErroModal_1").show();
        } else {
          $("#msgErroModal_1").hide();
        }
    },
    rules: {
      nome: {
        required: true
      }, 
      email: {
        required: true,
        email: true
      },
      cpf: {
        required: true
      }
    }
  });

  $("#formAlterarSenha").validate({
      invalidHandler: function(e, validator) {
          var errors = validator.numberOfInvalids();
          if (errors) {
              $("#msgErroModal_2 p").html("Existem erros no formulário.");
              $("#msgErroModal_2").show();
          } else {
            $("#msgErroModal_2").hide();
          }
      },
      rules: {
          senha_1 : {
              required: true
          },
          senha_2 : {
              required: true,
              equalTo: "#senha_1"
          }
      }
  });
});

function abrirModalAlterarSenha(){
  var elModal = $('#alterarSenhaModal');
  elModal.find('input, textarea, select').removeAttr('disabled');
  limparModalAlterarSenha();
  $('#btnAlterarSenha').removeAttr('disabled');
  $('#alterarSenhaModal').modal('show');
}

function limparModalAlterarSenha(){
  $('#formAlterarSenha label.error').remove();
  $('#formAlterarSenha .error').removeClass('error');
  $('#msgErroModal_2').hide();
  var elModal = $('#alterarSenhaModal');
  elModal.find('input, textarea, select').not('#usuarioId').val('');
}