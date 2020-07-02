function Produto() {



    this.listarProduto = function () {

        carregarDados('../controllers/ControllerProduto.php?acao=listar','POST');

        var json = jsonDados;

        //Monta a tabela de produtos.
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

                    for(var i in json.dados){
                        html += '<tr>';
                        html += '<th scope="row">'+json.dados[i].prkProduto+'</th>';

                        html += '<td>'+json.dados[i].nomeProduto+'</td>';

                        html += '<td>'+json.dados[i].precoProduto+'</td>';

                        html += '<td><button class="btn btn-primary" value="editar"  ' +
                            'onclick="new Produto().abreModalEditarProduto(\''+json.dados[i].nomeProduto+'\' ' +
                            ', '+json.dados[i].prkProduto+' , '+json.dados[i].precoProduto+');">Editar</button></td>';

                        html += '<td><button class="btn btn-primary"  value="excluir" ' +
                            'onclick="new Produto().deletarProduto('+json.dados[i].prkProduto+')">Excluir</button></td>';

                        html += '<td><input  type="checkbox" class="form-check-input-prkProduto"  value="'+json.dados[i].prkProduto+'"></td>';


                        html += '</tr>';

                    }
            html += '</tbody>';

            $("#tabelaPrincipal").html(html);
            $("#tabelaProdutos").DataTable({ //Adiciona o dataTables na tabela gerada.

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

            //Adiciona caracterização da tabela atual.
            $("#nomeTabelaAtual").html('Produtos');
            $("#abreModal").html('Inserir novo produto');
            $("#deletarSelecionados").attr("onClick" ,"new Produto().deletarTodosProdutosSelecionados();");



            //Rotinas padrões para remoção/inserção dos modais da tabela atual.
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

        //Caso a reposta do back seja negativa exibe a mensagem de erro para o usuário.
        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }



        //Caso a resposta seja positiva fecha o modal de inserção e lista novamnete os pedidos.
        $('#modalInserirGenerico').modal('toggle');
        this.listarProduto();



    };

    this.deletarProduto = function (prkProduto) {

        carregarDados('../controllers/ControllerProduto.php?acao=deletar',
            'POST','&prkProduto='+prkProduto);

        var json = jsonDados;


        //Caso a reposta do back seja negativa exibe a mensagem de erro para o usuário.
        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }


        //lista novamente a lista com os dados atualizados.
        this.listarProduto();


    };

    this.editarProduto = function (prkProduto) {

        var nomeProduto = $('#editarNomeProduto').val();
        var precoProduto = $('#editarPrecoProduto').val();

        carregarDados('../controllers/ControllerProduto.php?acao=editar',
            'POST','&prkProduto='+prkProduto+'&nomeProduto='+nomeProduto+'&precoProduto='+precoProduto);

        var json = jsonDados;

        //Caso a reposta do back seja negativa exibe a mensagem de erro para o usuário.
        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }



        //Caso a resposta seja positiva fecha o modal de edição e lista novamnete os produtos.
        $('#modalEditarGenerico').modal('toggle');
        this.listarProduto();

    };


    this.montaModalInserirProduto= function (){


        //monta o modal de inserção de produtos.
        var html ='<form id="formModalInserirProduto">'+
                    '<div class="form-group">'+
                        '<label for="recipient-name" class="col-form-label">Nome do produto</label>'+
                        '<input type="text" class="form-control" id="inserirNomeProduto" name="nomeProduto">'+
                        '<label for="recipient-name" class="col-form-label">Preco</label>'+
                        '<input type="text" class="form-control" id="inserirPrecoProduto" name="precoProduto" placeholder="ex: 500.00">'+
                    '</div>'+
                 '</form>';


        //Adiciona o modal de inserção de produtos ao modalInserirGenerico e o caracteriza.
        $('#formularioModalInserirGenerico').html(html);
        $('#labelModalInserirGenerico').html('Novo Produto');
        $('#modalInserirGenerico #botaoSalvarModal').attr("onClick" ,"new Produto().inserirProduto()");

    };

    this.montaModalEditarProduto = function (){


        //monta o modal de edição de produtos.
        var html ='<form id="formModalEditarProduto">'+
                        '<div class="form-group">'+
                            '<label for="recipient-name" class="col-form-label">Nome do produto</label>'+
                            '<input type="text" class="form-control" id="editarNomeProduto" name="nomeProduto">'+
                            '<label for="recipient-name" class="col-form-label">Preco Produto</label>'+
                            '<input type="text" class="form-control" id="editarPrecoProduto" name="precoProduto">'+
                        '</div>'+
                    '</form>';



        //Adiciona o modal de edição de produtos ao modalEditarGenerico e o caracteriza.
        $('#formularioModalEditarGenerico').html(html);
        $('#modalEditarGenericoLabel').html('Editar produto');


    };


    this.abreModalEditarProduto = function (nomeProduto,prkProduto,precoProduto) {
        //pega as informações da linha clicada, adiciona o evente ao botão de editar e abre o modal.
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