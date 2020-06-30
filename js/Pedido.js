function Pedido() {



    this.listarPedido = function () {

        carregarDados('../controllers/ControllerPedido.php?acao=listar','POST');


        var json = jsonDados;


        var html =  '<table id="tabelaPedidos"  class="table"  style="width:100%">'+
            '<thead>'+
            '<tr>'+
            '<th >id</th>'+
            '<th >nomeCliente</th>'+
            '<th >nomeProduto</th>'+
            '<th >status</th>'+
            '<th ></th>'+
            '<th ></th>'+
            '<th><input type="checkbox" class="form-check-input" id="ativaTodosChecksClientes" style="top:50px;"></th>'+
            '</tr>'+
            '</thead>'+
            '<tbody>';

        for(var i in jsonDados.dados){
            html += '<tr>';
            html += '<th scope="row">'+jsonDados.dados[i].prkPedido+'</th>';

            html += '<td>'+jsonDados.dados[i].nomeCliente+'</td>';
            html += '<td>'+jsonDados.dados[i].nomeProduto+'</td>';
            html += '<td>'+jsonDados.dados[i].status+'</td>';

            html += '<td><button class="btn btn-primary"  value="editar"  ' +
                'onclick="new Pedido().abreModalEditarPedido('+jsonDados.dados[i].prkPedido+');">Editar</button></td>';

            html += '<td><button class="btn btn-primary"  value="excluir" ' +
                'onclick="new Pedido().deletarPedido('+jsonDados.dados[i].prkPedido+')">Excluir</button></td>';

            html += '<td><input  type="checkbox" class="form-check-input-prkPedido"  value="'+jsonDados.dados[i].prkPedido+'"></td>';

            html += '</tr>';

        }
        html += '</tbody>';

        $("#tabelaPrincipal").html(html);
        $("#tabelaPedidos").DataTable({
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
                    "targets": 6,
                    "orderable": false,
                    "searchable": false,
                }

            ]
        });
        $("#nomeTabelaAtual").html('Pedidos');
        $("#abreModal").html('Inserir novo pedido');

        new Gerais().limpaModalInserir();
        new Gerais().limpaModalEditar();
        new Gerais().ativaTodosChecksClientes();
        this.montaModalInserirPedido();
        this.montaModalEditarPedido();



    };

    this.inserirPedido = function () {

        var frkProduto = $('#modalInserirGenerico #formModalInserirPedido #selectProdutoMoldalInserir').find('option:selected').attr('id');
        var frkCliente = $('#modalInserirGenerico #formModalInserirPedido #selectClienteMoldalInserir').find('option:selected').attr('id');
        var status = $('#modalInserirGenerico #formModalInserirPedido #selectStatusMoldalInserir').find('option:selected').attr('name');



        carregarDados('../controllers/ControllerPedido.php?acao=inserir',
            'POST','&frkProduto='+frkProduto+'&frkCliente='+frkCliente+'&status='+status);

        var json = jsonDados;


        if(json.res == '1'){
            $('#modalInserirGenerico').modal('toggle');
            this.listarPedido();
        }



    };

    this.deletarPedido = function (prkPedido) {

        carregarDados('../controllers/ControllerPedido.php?acao=deletar',
            'POST','&prkPedido='+prkPedido);

        var json = jsonDados;



        this.listarPedido();

    };

    this.editarPedido = function (prkPedido) {

        var frkProduto = $('#modalEditarGenerico #formModalEditarPedido #selectProdutoMoldalEditar').find('option:selected').attr('id');
        var frkCliente = $('#modalEditarGenerico #formModalEditarPedido #selectClienteMoldalEditar').find('option:selected').attr('id');
        var status = $('#modalEditarGenerico #formModalEditarPedido #selectStatusMoldalEditar').find('option:selected').attr('name');


        carregarDados('../controllers/ControllerPedido.php?acao=editar',
            'POST','&frkProduto='+frkProduto+'&frkCliente='+frkCliente+'&status='+status+'&prkPedido='+prkPedido);

        var json = jsonDados;


        if(json.res == '1'){
            $('#modalEditarGenerico').modal('toggle');
            this.listarPedido();
        }


    };



    this.montaModalInserirPedido = function () {

        carregarDados('../controllers/ControllerPedido.php?acao=getDadosModalInserir','POST');

        var json = jsonDados;



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



        $('#modalInserirGenerico #formularioModalInserirGenerico').html(html);
        $('#labelModalInserirGenerico').html('Novo Pedido');

    };

    this.montaModalEditarPedido = function () {

        carregarDados('../controllers/ControllerPedido.php?acao=getDadosModalInserir','POST');


        var json = jsonDados;


        var html =
            '<form id="formModalEditarPedido">'+
            '<div class="form-group">'+
            '<label for="recipient-name" class="col-form-label">Produtos Cadastrados</label>'+

            '<select class="form-control" id="selectProdutoMoldalEditar" name="frkProduto">';
        for(var i in json.dados[0]){
            html += '<option id='+json.dados[0][i].prkProduto+'>'+json.dados[0][i].nomeProduto+'</option>';
        }
        html +=     '</select>';

        html +=     '<label for="recipient-name" class="col-form-label">Clientes Cadastrados</label>';

        html +=         '<select class="form-control" id="selectClienteMoldalEditar" name="frkCliente">';
        for(var i in json.dados[1]){
            html += '<option id='+json.dados[1][i].prkCliente+'>'+json.dados[1][i].nomeCliente+'</option>';
        }
        html +=         '</select>';

        html +=     '<label for="recipient-name" class="col-form-label">Status do pedido</label>';
        html +=         '<select class="form-control" id="selectStatusMoldalEditar" name="status">';
        html +=             '<option name="A" id="pedidoStatusAberto">Aberto</option>';
        html +=             '<option name="P" id="pedidoStatusPago">Pago</option>';
        html +=             '<option name="C" id="pedidoStatusCancelado">Cancelado</option>';
        html +=         '</select>';




        html +=  '</div>';
        html +=  '</form>';



        $('#modalEditarGenerico #formularioModalEditarGenerico').html(html);
        $('#labelModalEditarGenerico').html('Editar Pedido');
        $('#modalEditarGenerico #botaoSalvarModal').attr("onClick" ,"new Pedido().editarPedido()");

    };



    this.limpaModalInserir = function() {
        var form =  document.querySelectorAll('#formularioModalInserirGenerico')[0].firstChild;

        if(form !== undefined){
            form.remove();
        }
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

        if(json.res == '1'){
            this.listarPedido();
        }

    };


    this.abreModalEditarPedido = function (prkPedido){
        $('#modalEditarGenerico #botaoSalvaAlteracoesModal').attr("onClick" ,"new Pedido().editarPedido("+prkPedido+")");
        $("#modalEditarGenerico").modal();
    }


}

