function Pedido() {



    this.listarPedido = function () {

        carregarDados('../controllers/ControllerPedido.php?acao=listar','POST');


        var json = jsonDados;


        //Monta a tabela de pedidos.
        var html =  '<table id="tabelaPedidos"  class="table"  style="width:100%">'+
            '<thead>'+
            '<tr>'+
                '<th >id</th>'+
                '<th >nomeCliente</th>'+
                '<th >nomeProduto</th>'+
                '<th >status</th>'+
                '<th ></th>'+
                '<th ></th>'+
                '<th ></th>'+
                '<th><input type="checkbox" class="form-check-input" id="ativaTodosChecksClientes" style="top:50px;"></th>'+
            '</tr>'+
            '</thead>'+
            '<tbody>';

                    for(var i in json.dados){
                        html += '<tr>';
                        html += '<th scope="row">'+jsonDados.dados[i].prkPedido+'</th>';

                        html += '<td>'+json.dados[i].nomeCliente+'</td>';
                        html += '<td>'+json.dados[i].nomeProduto+'</td>';
                        html += '<td>'+json.dados[i].status+'</td>';

                        html += '<td><button class="btn btn-primary"  value="editar"  ' +
                            'onclick="new Pedido().abreModalEditarPedido('+json.dados[i].prkPedido+');">Editar</button></td>';

                        html += '<td><button class="btn btn-primary"  value="excluir" ' +
                            'onclick="new Pedido().deletarPedido('+json.dados[i].prkPedido+')">Excluir</button></td>';

                        html += '<td><button class="btn btn-primary"  value="excluir" ' +
                            'onclick="new Pedido().abreModalInformacoesPedido('+json.dados[i].prkPedido+')">+ info</button></td>';

                        html += '<td><input  type="checkbox" class="form-check-input-prkPedido"  value="'+json.dados[i].prkPedido+'"></td>';

                        html += '</tr>';

                    }
        html += '</tbody>';

        $("#tabelaPrincipal").html(html);
        $("#tabelaPedidos").DataTable({ //Adiciona o dataTables na tabela gerada.
            "columnDefs": [
                {
                    "targets": 4,
                    "orderable": false,
                    "searchable": false,
                },
                {
                    "targets": 5,
                    "orderable": false,
                    "searchable": false,
                },
                {
                    "targets": 7,
                    "orderable": false,
                    "searchable": false,
                }

            ]
        });

        //Adiciona caracterização da tabela atual.
        $("#nomeTabelaAtual").html('Pedidos');
        $("#abreModal").html('Inserir novo pedido');
        $("#deletarSelecionados").attr("onClick" ,"new Pedido().deletarTodosPedidosSelecionados();");



        //Rotinas padrões para remoção/inserção dos modais da tabela atual.
        new Gerais().limpaModalInserir();
        new Gerais().limpaModalEditar();
        new Gerais().ativaTodosChecksClientes();
        this.montaModalInserirPedido();
        this.montaModalEditarPedido();
        this.montaModalInformacoesPedido();



    };

    this.inserirPedido = function () {

        //Seleciona as opções atuais de cada select do modalInserirPedido
        var frkProduto = $('#modalInserirGenerico #formModalInserirPedido #selectProdutoMoldalInserir').find('option:selected').attr('id');
        var frkCliente = $('#modalInserirGenerico #formModalInserirPedido #selectClienteMoldalInserir').find('option:selected').attr('id');
        var status = $('#modalInserirGenerico #formModalInserirPedido #selectStatusMoldalInserir').find('option:selected').attr('name');



        carregarDados('../controllers/ControllerPedido.php?acao=inserir',
            'POST','&frkProduto='+frkProduto+'&frkCliente='+frkCliente+'&status='+status);

        var json = jsonDados;

        //Caso a reposta do back seja negativa exibe a mensagem de erro para o usuário.
        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }



        //Caso a resposta seja positiva fecha o modal de inserção e lista novamnete os pedidos.
        $('#modalInserirGenerico').modal('toggle');
        this.listarPedido();




    };

    this.deletarPedido = function (prkPedido) {

        carregarDados('../controllers/ControllerPedido.php?acao=deletar',
            'POST','&prkPedido='+prkPedido);

        var json = jsonDados;

        //Caso a reposta do back seja negativa exibe a mensagem de erro para o usuário.
        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }



        //lista novamente a lista com os dados atualizados.
        this.listarPedido();

    };

    this.editarPedido = function (prkPedido) {

        var frkProduto = $('#modalEditarGenerico #formModalEditarPedido #selectProdutoMoldalEditar').find('option:selected').attr('id');
        var frkCliente = $('#modalEditarGenerico #formModalEditarPedido #selectClienteMoldalEditar').find('option:selected').attr('id');
        var status = $('#modalEditarGenerico #formModalEditarPedido #selectStatusMoldalEditar').find('option:selected').attr('name');


        carregarDados('../controllers/ControllerPedido.php?acao=editar',
            'POST','&frkProduto='+frkProduto+'&frkCliente='+frkCliente+'&status='+status+'&prkPedido='+prkPedido);

        var json = jsonDados;

        //Caso a reposta do back seja negativa exibe a mensagem de erro para o usuário.
        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }



        //Caso a resposta seja positiva fecha o modal de edição e lista novamnete os pedidos.
        $('#modalEditarGenerico').modal('toggle');
        this.listarPedido();


    };



    this.montaModalInserirPedido = function () {

        carregarDados('../controllers/ControllerPedido.php?acao=getDadosModalInserir','POST');

        var json = jsonDados;



        //monta modal de inserção de pedidos.
        var html =
            '<form id="formModalInserirPedido">'+
                '<div class="form-group">'+
                    '<label for="recipient-name" class="col-form-label">Produtos Cadastrados</label>'+

                    '<select class="form-control" id="selectProdutoMoldalInserir" name="frkProduto">';
                            for(var i in json.dados[0]){
                                html += '<option id='+json.dados[0][i].prkProduto+'>'+json.dados[0][i].nomeProduto+'</option>';
                            }
        html +=     '</select>';

        html +=     '<label for="recipient-name" class="col-form-label">Clientes Cadastrados</label>';

        html +=         '<select class="form-control" id="selectClienteMoldalInserir" name="frkCliente">';
                            for(var i in json.dados[1]){
                                html += '<option id='+json.dados[1][i].prkCliente+'>'+json.dados[1][i].nomeCliente+'</option>';
                            }
        html +=         '</select>';

        html +=     '<label for="recipient-name" class="col-form-label">Status do pedido</label>';
        html +=         '<select class="form-control" id="selectStatusMoldalInserir" name="status">';
        html +=             '<option name="A" id="pedidoStatusAberto">Aberto</option>';
        html +=             '<option name="P" id="pedidoStatusPago">Pago</option>';
        html +=             '<option name="C" id="pedidoStatusCancelado">Cancelado</option>';
        html +=         '</select>';




        html +=  '</div>';
        html +=  '</form>';



        //Adiciona o modal de inserção de pedidos ao modalInserirGenerico e o caracteriza.
        $('#modalInserirGenerico #formularioModalInserirGenerico').html(html);
        $('#labelModalInserirGenerico').html('Novo Pedido');
        $('#modalInserirGenerico #botaoSalvarModal').attr("onClick" ,"new Pedido().inserirPedido()");

    };

    this.montaModalEditarPedido = function () {

        carregarDados('../controllers/ControllerPedido.php?acao=getDadosModalInserir','POST');


        var json = jsonDados;


        //monta o modal de edição de pedidos.
        var html =
            '<form id="formModalEditarPedido">'+
            '<div class="form-group">'+
                '<label for="recipient-name" class="col-form-label">Produtos Cadastrados</label>'+

                '<select class="form-control" id="selectProdutoMoldalEditar" name="frkProduto">';
                    for(var i in json.dados[0])
                    {
                        html += '<option id='+json.dados[0][i].prkProduto+'>'+json.dados[0][i].nomeProduto+'</option>';
                    }
        html +=  '</select>';

        html +=  '<label for="recipient-name" class="col-form-label">Clientes Cadastrados</label>';

        html +=  '<select class="form-control" id="selectClienteMoldalEditar" name="frkCliente">';
                    for(var i in json.dados[1])
                    {
                        html += '<option id='+json.dados[1][i].prkCliente+'>'+json.dados[1][i].nomeCliente+'</option>';
                    }
        html +=  '</select>';

        html +=   '<label for="recipient-name" class="col-form-label">Status do pedido</label>';
        html +=    '<select class="form-control" id="selectStatusMoldalEditar" name="status">';
        html +=        '<option name="A" id="pedidoStatusAberto">Aberto</option>';
        html +=       '<option name="P" id="pedidoStatusPago">Pago</option>';
        html +=       '<option name="C" id="pedidoStatusCancelado">Cancelado</option>';
        html +=    '</select>';


        html +=  '</div>';
        html +=  '</form>';



        //Adiciona o modal de edição de pedidos ao modalEditarGenerico e o caracteriza.
        $('#modalEditarGenerico #formularioModalEditarGenerico').html(html);
        $('#labelModalEditarGenerico').html('Editar Pedido');
        $('#modalEditarGenerico #botaoSalvarModal').attr("onClick" ,"new Pedido().editarPedido()");

    };

    this.abreModalEditarPedido = function (prkPedido){
        //Pega o prk do pedido da linha clicada, adiciona o evento de editar o cliente da linha clicada e abre o modal.
        $('#modalEditarGenerico #botaoSalvaAlteracoesModal').attr("onClick" ,"new Pedido().editarPedido("+prkPedido+")");
        $("#modalEditarGenerico").modal();
    };

    this.montaModalInformacoesPedido = function () {


        //monta o modal de informações do pedido.
        var html ='<form id="formModalInformacoesPedido">'+
            '<div class="form-group">'+
                '<label for="recipient-name" class="col-form-label">Nome do Cliente</label>'+
                '<input type="text" class="form-control" id="infoNomeCliente" name="nomeCliente" disabled>'+
                '<label for="recipient-name" class="col-form-label">Valor Pago</label>'+
                '<input type="text" class="form-control" id="infoPrecoProduto" name="nomeCliente" disabled>'+
                '<label for="recipient-name" class="col-form-label">Status</label>'+
                '<input type="text" class="form-control" id="infoStatusCliente" name="nomeCliente" disabled>'+
                '<label for="recipient-name" class="col-form-label">Produto</label>'+
                '<input type="text" class="form-control" id="infoNomeProduto" name="nomeCliente" disabled>'+
            '</div>'+
            '</form>';




        //Adiciona o modal de informações de pedidos ao modalInformacoesGenerico e o caracteriza.
        $('#modalInformacoesGenerico #formularioModalInformacoesGenerico').html(html);
        $('#modalInformacoesGenericoLabel').html('Informações do cliente');

    };

    this.abreModalInformacoesPedido = function (prkPedido) {

        carregarDados('../controllers/ControllerPedido.php?acao=getDadosModalInfoCliente','POST',
            '&prkPedido='+prkPedido);

        var json = jsonDados;

        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }

        //Adiciona as informações do pedido do cliente ao modal e abre o modalInformacoesGenerico.
        $('#modalInformacoesGenerico #infoNomeCliente').val(json.dados[0].nomeCliente);
        $('#modalInformacoesGenerico #infoPrecoProduto').val(json.dados[0].precoProduto);
        $('#modalInformacoesGenerico #infoStatusCliente').val(json.dados[0].status);
        $('#modalInformacoesGenerico #infoNomeProduto').val(json.dados[0].nomeProduto);
        $("#modalInformacoesGenerico").modal();

    };


    this.deletarTodosPedidosSelecionados = function () {

        var checksSelecionados = document.querySelectorAll("#tabelaPedidos_wrapper .form-check-input-prkPedido");
        var prkPedido = [];


        for(var i = 0; i < checksSelecionados.length; i++){

            if(checksSelecionados[i].checked === false){
                continue;
            }

            prkPedido[i] =  checksSelecionados[i].value;
        }

        prkPedido = new Gerais().removePosicaoVazia(prkPedido);

        if(prkPedido === null){
            return;
        }


        carregarDados('../controllers/ControllerPedido.php?acao=deletarVarios',
            'POST','&prkPedido='+prkPedido);

        var json = jsonDados;

        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }

        this.listarPedido();


    };




}

