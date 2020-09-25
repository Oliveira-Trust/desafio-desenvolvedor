  function abrirModalNovo(){
    var elModal = $('#manterProdutoModal');
    elModal.find('input, textarea, select').removeAttr('disabled');
    limparModal();
    $('#salvarProduto').removeAttr('disabled');
    $('#manterProdutoModal').modal('show');
  }

  function abrirModalEditar(id){
    var elModal = $('#manterProdutoModal');
    elModal.find('input, textarea, select').removeAttr('disabled');
    limparModal();
    preencheModal(id);
    $('#salvarProduto').removeAttr('disabled');
    $('#manterProdutoModal').modal('show');
  }

  function abrirModalDetalhar(id){
    var elModal = $('#manterProdutoModal');
    elModal.find('input, textarea, select').attr('disabled', 'disabled');
    limparModal();
    preencheModal(id);
    $('#salvarProduto').attr('disabled', 'disabled');
    $('#manterProdutoModal').modal('show');
  }

  function limparModal(){
    $('#formManterProdutos label.error').remove();
    $('#formManterProdutos .error').removeClass('error');
    $('#msgErroModal').hide();
    var elModal = $('#manterProdutoModal');
    elModal.find('input, textarea, select').val('');
  }

  function preencheModal(id){
    $.get('/produtos/' + id, function(dados){
      $('#produtoId').val(id);
      $('#nm_produto').val(dados.nm_produto);
      $('#ds_produto').val(dados.ds_produto);
      $('#vl_produto').val(dados.vlProduto);
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
                    window.location = '/produtos/inativar/' + id;
                }
            }
        }
    });
  }

  $.validator.messages.required = "Este campo é obrigátório";
  $.validator.messages.email = "Email inválido";
  $("#formManterProdutos").validate({
      invalidHandler: function(e, validator) {
        var errors = validator.numberOfInvalids();
        if (errors) {
            $("#msgErroModal p").html("Existem erros no formulário.");
            $("#msgErroModal").show();
        } else {
          $("#msgErroModal").hide();
          $("#formManterProdutos").attr('disabled', 'disabled');
        }
    },
    rules: {
      nm_produto: {
        required: true
      },
      ds_produto: {
        required: true
      },
      vl_produto: {
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