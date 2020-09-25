  function abrirModalNovo(){
    var elModal = $('#manterClienteModal');
    elModal.find('input, textarea, select').removeAttr('disabled');
    limparModal();
    $('#salvarCliente').removeAttr('disabled');
    $('#manterClienteModal').modal('show');
  }

  function abrirModalEditar(id){
    var elModal = $('#manterClienteModal');
    elModal.find('input, textarea, select').removeAttr('disabled');
    limparModal();
    preencheModal(id);
    $('#salvarCliente').removeAttr('disabled');
    $('#manterClienteModal').modal('show');
  }

  function abrirModalDetalhar(id){
    var elModal = $('#manterClienteModal');
    elModal.find('input, textarea, select').attr('disabled', 'disabled');
    limparModal();
    preencheModal(id);
    $('#salvarCliente').attr('disabled', 'disabled');
    $('#manterClienteModal').modal('show');
  }

  function limparModal(){
    $('#formManterClientes label.error').remove();
    $('#formManterClientes .error').removeClass('error');
    $('#msgErroModal').hide();
    var elModal = $('#manterClienteModal');
    elModal.find('input, textarea, select').val('');
  }

  function preencheModal(id){
    $.get('/clientes/' + id, function(dados){
      $('#clienteId').val(id);
      $('#nm_cliente').val(dados.nm_cliente);
      $('#telefone').val(dados.telefone);
      $('#email').val(dados.email);
      $('#cpf').val(dados.cpf);
      $('#endereco_completo').val(dados.endereco_completo);
    });
  }

  function inativar(id){
    $.confirm({
        title: 'Confirma a ação.',
        content: 'Tem certeza que deseja realizar essa ação?',
        buttons: {
            cancel: {
                text: 'Cancelar',
                btnClass: 'btn-default',
                keys: ['enter', 'shift']
            },
            confirm: {
                text: 'Confirmar',
                btnClass: 'btn-success',
                keys: ['enter', 'shift'],
                action: function(){
                    window.location = '/clientes/inativar/' + id;
                }
            }
        }
    });
  }

  $.validator.messages.required = "Este campo é obrigátório";
  $.validator.messages.email = "Email inválido";
  $("#formManterClientes").validate({
      invalidHandler: function(e, validator) {
        var errors = validator.numberOfInvalids();
        if (errors) {
            $("#msgErroModal p").html("Existem erros no formulário.");
            $("#msgErroModal").show();
        } else {
          $("#msgErroModal").hide();
          $("#formManterClientes").attr('disabled', 'disabled');
        }
    },
    rules: {
      nm_cliente: {
        required: true
      },
      telefone: {
        required: true
      },
      email: {
        email: true,
        required: true
      },
      cpf: {
        required: true
      },
      endereco_completo: {
        required: true
      },
    }
  });

  function marcarDesmarcar(el){
    $(".ids").each(
        function() {
            if(el.prop('checked')){
              $('#btnExcluirMarcados').removeAttr('disabled');
              $(this).prop("checked", true);
            }else {
              $('#btnExcluirMarcados').attr('disabled', 'disabled');
              $(this).prop("checked", false);
            }
        }
    );
  }

  function habilitaDesabilitaBtnExcluirMarcados(){
    if($('.ids:checkbox:checked').length > 0){
      $('#btnExcluirMarcados').removeAttr('disabled');
    }else {
      $('#btnExcluirMarcados').attr('disabled', 'disabled');
    }
  }