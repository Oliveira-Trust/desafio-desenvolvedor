function Produto() {



    this.listarProduto = function () {

        carregarDados('../controllers/ControllerProduto.php?acao=listar','POST');

        var json = jsonDados;

        var html =  '<table id="tabelaProdutos"  class="table"  style="width:100%">'+
            '<thead>'+
            '<tr>'+
                '<th >id</th>'+
                '<th >Produto</th>'+
                '<th >Preco</th>'+
                '<th ></th>'+
                '<th ></th>'+
                '<th><input type="checkbox" class="form-check-input" id="ativaTodosChecksClientes" style="top:50px;"></th>'+
            '</tr>'+
            '</thead>'+
            '<tbody>';

                    for(var i in jsonDados.dados){
                        html += '<tr>';
                        html += '<th scope="row">'+jsonDados.dados[i].prkProduto+'</th>';

                        html += '<td>'+jsonDados.dados[i].nomeProduto+'</td>';

                        html += '<td>'+jsonDados.dados[i].precoProduto+'</td>';

                        html += '<td><button class="btn btn-primary" value="editar"  ' +
                            'onclick="new Produto().abreModalEditarProduto(\''+jsonDados.dados[i].nomeProduto+'\' ' +
                            ', '+jsonDados.dados[i].prkProduto+' , '+jsonDados.dados[i].precoProduto+');">Editar</button></td>';

                        html += '<td><button class="btn btn-primary"  value="excluir" ' +
                            'onclick="new Produto().deletarProduto('+jsonDados.dados[i].prkProduto+')">Excluir</button></td>';

                        html += '<td><input  type="checkbox" class="form-check-input-prkProduto"  value="'+jsonDados.dados[i].prkProduto+'"></td>';


                        html += '</tr>';

                    }
            html += '</tbody>';

            $("#tabelaPrincipal").html(html);
            $("#tabelaProdutos").DataTable({
                "columnDefs": [
                    {
                        "targets": 3,
                        "orderable": false,
                        "searchable": false,
                    },
                    {
                        "targets": 4,
                        "orderable": false,
                        "searchable": false,
                    },
                    {
                        "targets": 5,
                        "orderable": false,
                        "searchable": false,
                    }

                ]
            });

            $("#nomeTabelaAtual").html('Produtos');
            $("#abreModal").html('Inserir novo produto');
            $("#deletarSelecionados").attr("onClick" ,"new Produto().deletarTodosProdutosSelecionados();");



            new Gerais().limpaModalInserir();
            new Gerais().limpaModalEditar();
            new Gerais().ativaTodosChecksClientes();
            this.montaModalEditarProduto();
            this.montaModalInserirProduto();

    };

    this.inserirProduto = function () {

        var form = $('#modalInserirGenerico #formModalInserirProduto').serialize();


        carregarDados('../controllers/ControllerProduto.php?acao=inserir',
            'POST',form);

        var json = jsonDados;

        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }



        $('#modalInserirGenerico').modal('toggle');
        this.listarProduto();



    };

    this.deletarProduto = function (prkProduto) {

        carregarDados('../controllers/ControllerProduto.php?acao=deletar',
            'POST','&prkProduto='+prkProduto);

        var json = jsonDados;


        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }


        $('#modalInserirGenerico').modal('toggle');
        this.listarProduto();


    };

    this.editarProduto = function (prkProduto) {

        var nomeProduto = $('#editarNomeProduto').val();
        var precoProduto = $('#editarPrecoProduto').val();

        carregarDados('../controllers/ControllerProduto.php?acao=editar',
            'POST','&prkProduto='+prkProduto+'&nomeProduto='+nomeProduto+'&precoProduto='+precoProduto);

        var json = jsonDados;

        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }

        $('#modalEditarGenerico').modal('toggle');
        this.listarProduto();



    };


    this.montaModalInserirProduto= function (){


        var html ='<form id="formModalInserirProduto">'+
                    '<div class="form-group">'+
                        '<label for="recipient-name" class="col-form-label">Nome do produto</label>'+
                        '<input type="text" class="form-control" id="inserirNomeProduto" name="nomeProduto">'+
                        '<label for="recipient-name" class="col-form-label">Preco</label>'+
                        '<input type="text" class="form-control" id="inserirPrecoProduto" name="precoProduto">'+
                    '</div>'+
                 '</form>';


        $('#formularioModalInserirGenerico').html(html);
        $('#labelModalInserirGenerico').html('Novo Produto');
        $('#modalInserirGenerico #botaoSalvarModal').attr("onClick" ,"new Produto().inserirProduto()");

    };

    this.montaModalEditarProduto = function (){

        var html ='<form id="formModalEditarProduto">'+
                        '<div class="form-group">'+
                            '<label for="recipient-name" class="col-form-label">Nome do produto</label>'+
                            '<input type="text" class="form-control" id="editarNomeProduto" name="nomeProduto">'+
                            '<label for="recipient-name" class="col-form-label">Preco Produto</label>'+
                            '<input type="text" class="form-control" id="editarPrecoProduto" name="precoProduto">'+
                        '</div>'+
                    '</form>';

        $('#formularioModalEditarGenerico').html(html);
        $('#modalEditarGenericoLabel').html('Editar produto');


    };


    this.abreModalEditarProduto = function (nomeProduto,prkProduto,precoProduto) {
        $('#modalEditarGenerico #editarNomeProduto').val(nomeProduto);
        $('#modalEditarGenerico #editarPrecoProduto').val(precoProduto);
        $('#modalEditarGenerico #botaoSalvaAlteracoesModal').attr("onClick" ,"new Produto().editarProduto("+prkProduto+")");
        $("#modalEditarGenerico").modal();
    };



    this.deletarTodosProdutosSelecionados = function (){

        var checksSelecionados = document.querySelectorAll("#tabelaProdutos_wrapper .form-check-input-prkProduto");
        var prkProduto = [];


        for(var i = 0; i < checksSelecionados.length; i++){

            if(checksSelecionados[i].checked === false){
                continue;
            }

            prkProduto[i] =  checksSelecionados[i].value;
        }

        prkProduto = new Gerais().removePosicaoVazia(prkProduto);

        if(prkProduto === null){
            return;
        }


        carregarDados('../controllers/ControllerProduto.php?acao=deletarVarios',
            'POST','&prkProduto='+prkProduto);

        var json = jsonDados;

        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }

        this.listarProduto();



    };


}