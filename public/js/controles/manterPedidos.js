  function abrirModalNovo(){
    var elModal = $('#manterPedidoModal');
    elModal.find('input, textarea, select').removeAttr('disabled');
    limparModal();
    $('#salvarPedido').removeAttr('disabled');
    $('#manterPedidoModal').modal('show');
  }

  function abrirModalEditar(id){
    var elModal = $('#manterPedidoModal');
    elModal.find('input, textarea, select').removeAttr('disabled');
    limparModal();
    preencheModal(id);
    $('#salvarPedido').removeAttr('disabled');
    $('#manterPedidoModal').modal('show');
  }

  function abrirModalDetalhar(id){
    var elModal = $('#manterPedidoModal');
    elModal.find('input, textarea, select').attr('disabled', 'disabled');
    limparModal();
    preencheModal(id);
    $('#salvarPedido').attr('disabled', 'disabled');
    $('#manterPedidoModal').modal('show');
  }

  function limparModal(){
    $('#formManterPedidos label.error').remove();
    $('#formManterPedidos .error').removeClass('error');
    $('#msgErroModal').hide();
    var elModal = $('#manterPedidoModal');
    elModal.find('input, textarea, select').val('');
  }

  function preencheModal(id){
    $.get('/pedidos/' + id, function(dados){
      $('#pedidoId').val(id);
      $('#dt_pedido').val(dados.dtPedido);
      $('#cliente_id').val(dados.cliente_id);
      $('#produto_id').val(dados.produto_id);
      $('#pedido_status_id').val(dados.pedido_status_id);
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
                    window.location = '/pedidos/inativar/' + id;
                }
            }
        }
    });
  }

  $.validator.messages.required = "Este campo é obrigátório";
  $("#formManterPedidos").validate({
      invalidHandler: function(e, validator) {
        var errors = validator.numberOfInvalids();
        if (errors) {
            $("#msgErroModal p").html("Existem erros no formulário.");
            $("#msgErroModal").show();
        } else {
          $("#msgErroModal").hide();
          $("#formManterPedidos").attr('disabled', 'disabled');
        }
    },
    rules: {
      dt_pedido: {
        required: true
      },
      cliente_id: {
        required: true
      },
      produto_id: {
        required: true
      },
      pedido_status_id: {
        required: true
      }
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

  /* Modal e ações Cliente */

  function abrirModalDetalharCliente(id){
    var elModal = $('#manterClienteModal');
    elModal.find('input, textarea, select').attr('disabled', 'disabled');
    limparModalCliente();
    preencheModalCliente(id);
    $('#salvarCliente').attr('disabled', 'disabled');
    $('#manterClienteModal').modal('show');
  }

  function limparModalCliente(){
    $('#formManterClientes label.error').remove();
    $('#formManterClientes .error').removeClass('error');
    $('#msgErroModal').hide();
    var elModal = $('#manterClienteModal');
    elModal.find('input, textarea, select').val('');
  }

  function preencheModalCliente(id){
    $.get('/clientes/' + id, function(dados){
      $('#clienteId').val(id);
      $('#nm_cliente').val(dados.nm_cliente);
      $('#telefone').val(dados.telefone);
      $('#email').val(dados.email);
      $('#cpf').val(dados.cpf);
      $('#endereco_completo').val(dados.endereco_completo);
    });
  }

  /* Fim - modal e ações Cliente */

  /* Modal e ações Produto */

  function abrirModalDetalharProduto(id){
    var elModal = $('#manterProdutoModal');
    elModal.find('input, textarea, select').attr('disabled', 'disabled');
    limparModalProduto();
    preencheModalProduto(id);
    $('#salvarProduto').attr('disabled', 'disabled');
    $('#manterProdutoModal').modal('show');
  }

  function limparModalProduto(){
    $('#formManterProdutos label.error').remove();
    $('#formManterProdutos .error').removeClass('error');
    $('#msgErroModal').hide();
    var elModal = $('#manterProdutoModal');
    elModal.find('input, textarea, select').val('');
  }

  function preencheModalProduto(id){
    $.get('/produtos/' + id, function(dados){
      $('#produtoId').val(id);
      $('#nm_produto').val(dados.nm_produto);
      $('#ds_produto').val(dados.ds_produto);
      $('#vl_produto').val(dados.vlProduto);
    });
  }

  /* Fim - modal e ações Produto */
