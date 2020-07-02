function Cliente() {

    this.init = function () {
        // Parametro utilizado para controlar a inicialização da tabela; Caso for a primeira vez não limpa os modais.
        var primeiraVez = true;

        // inicialização da tabela.
        this.listarCliente(primeiraVez);
        this.montaModalInserirCliente();
        this.montaModalEditarCliente();
    };

    this.listarCliente = function (primeiraVez = false) {

        carregarDados('../controllers/ControllerCliente.php?acao=listar','POST');


        var json = jsonDados;

        //Monta a tabela de clientes.
        var html =  '<table id="tabelaClientes"  class="table"  style="width:100%">'+
                    '<thead>'+
                        '<tr>'+
                            '<th >id</th>'+
                            '<th >nome</th>'+
                            '<th ></th>'+
                            '<th ></th>'+
                            '<th><input type="checkbox" class="form-check-input" id="ativaTodosChecksClientes" style="top:50px;"></th>'+
                        '</tr>'+
                    '</thead>'+
                     '<tbody>';

                        for(var i in json.dados){
                            html += '<tr>';
                            html += '<th scope="row">'+json.dados[i].prkCliente+'</th>';

                            html += '<td>'+json.dados[i].nomeCliente+'</td>';

                            html += '<td><button class="btn btn-primary"  value="editar"  ' +
                                'onclick="new Cliente().abreModalEditarCliente(\''+json.dados[i].nomeCliente+'\' , '+json.dados[i].prkCliente+');">Editar</button></td>';

                            html += '<td><button class="btn btn-primary"  value="excluir" ' +
                                'onclick="new Cliente().deletarCliente('+json.dados[i].prkCliente+')">Excluir</button></td>';

                            html += '<td><input  type="checkbox" class="form-check-input-prkCliente"  value="'+json.dados[i].prkCliente+'"></td>';


                            html += '</tr>';

                        }
                html += '</tbody>';

                $("#tabelaPrincipal").html(html);
                $("#tabelaClientes").DataTable({ //Adiciona o dataTables na tabela gerada.
                        "columnDefs": [

                            {
                                "targets": 2,
                                "orderable": false,
                                "searchable": false,

                            },
                            {
                                "targets": 3,
                                "orderable": false,
                                "searchable": false,
                            },
                            {
                                "targets": 4,
                                "orderable": false,
                                "searchable": false,
                            }

                        ]
                });

                //Adiciona caracterização da tabela atual.
                $("#nomeTabelaAtual").html('Clientes');
                $("#abreModal").html('Inserir novo cliente');
                $("#deletarSelecionados").attr("onClick" ,"new Cliente().deletarTodosClientesSelecionados();");


                //Rotinas padrões para remoção/inserção dos modais da tabela atual.
                new Gerais().limpaModalEditar(primeiraVez);
                new Gerais().limpaModalInserir(primeiraVez);
                new Gerais().ativaTodosChecksClientes();
                this.montaModalInserirCliente();
                this.montaModalEditarCliente();


    };

    this.inserirCliente = function () {

        var form = $('#modalInserirGenerico #formModalInserirCliente').serialize();


        carregarDados('../controllers/ControllerCliente.php?acao=inserir',
            'POST',form);

        var json = jsonDados;

        //Caso a reposta do back seja negativa exibe a mensagem de erro para o usuário.
        if(json.res == '0') {
           new Gerais().exibirMensagemErro(json.msg);
           return;
        }



        //Caso a resposta seja positiva fecha o modal de inserção e lista novamnete os clientes.
        $('#modalInserirGenerico').modal('toggle');
        this.listarCliente();


    };

    this.deletarCliente = function (prkCliente) {

        carregarDados('../controllers/ControllerCliente.php?acao=deletar',
            'POST','&prkCliente='+prkCliente);

        var json = jsonDados;

        //Caso a reposta do back seja negativa exibe a mensagem de erro para o usuário.
        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }



        //lista novamente a lista com os dados atualizados.
        this.listarCliente();


    };

    this.editarCliente = function (prkCliente) {

        var nomeCliente = $('#editarNomeCliente').val();

        carregarDados('../controllers/ControllerCliente.php?acao=editar',
            'POST','&prkCliente='+prkCliente+'&nomeCliente='+nomeCliente);

        var json = jsonDados;


        //Caso a reposta do back seja negativa exibe a mensagem de erro para o usuário.
        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }


        //Caso a resposta seja positiva fecha o modal de inserção e lista novamnete os clientes.
        $('#modalEditarGenerico').modal('toggle');
        this.listarCliente();


    };

    this.montaModalInserirCliente = function () {

        //Monta o modal de inserção de clientes.
        var html ='<form id="formModalInserirCliente">'+
                        '<div class="form-group">'+
                            '<label for="recipient-name" class="col-form-label">Nome do Cliente</label>'+
                            '<input type="text" class="form-control" id="nomeCliente" name="nomeCliente">'+
                        '</div>'+
                  '</form>';



        //Adiciona o modal de inserção de clientes ao modalGenerico e o caracteriza.
        $('#modalInserirGenerico #formularioModalInserirGenerico').html(html);
        $('#labelModalInserirGenerico').html('Novo Cliente');
        $('#modalInserirGenerico #botaoSalvarModal').attr("onClick" ,"new Cliente().inserirCliente()");

    };

    this.montaModalEditarCliente = function (){

        //Monta o modal de edição de clientes.
        var html =  '<form id="formModalEditarCliente">'+
                        '<div class="form-group">'+
                            '<label for="recipient-name" class="col-form-label">Nome do cliente</label>'+
                            '<input type="text" class="form-control" id="editarNomeCliente" name="nomeCliente">'+
                        '</div>'+
                   '</form>';


         //Adiciona o modal de edição de clientes ao modalEditarGenerico e o caracteriza.
         $('#formularioModalEditarGenerico').html(html);
         $('#modalEditarGenericoLabel').html('Editar cliente');

    };


    this.abreModalEditarCliente = function (nomeCliente, prkCliente) {

        //Pega o nome do cliente da linha clicada, adiciona o evento de editar o cliente da linha clicada e abre o modal.
        $('#modalEditarGenerico #editarNomeCliente').val(nomeCliente);
        $('#modalEditarGenerico #botaoSalvaAlteracoesModal').attr("onClick" ,"new Cliente().editarCliente("+prkCliente+")");
        $("#modalEditarGenerico").modal();
    };


    this.deletarTodosClientesSelecionados = function (){

        var checksSelecionados = document.querySelectorAll("#tabelaClientes_wrapper .form-check-input-prkCliente");
        var prkCliente = [];


        //Busca  checks selecionados e pega o prk deles.
        for(var i = 0; i < checksSelecionados.length; i++){

            if(checksSelecionados[i].checked === false){
                continue;
            }

            prkCliente[i] =  checksSelecionados[i].value;
        }


        //Caso tenha alguma posição vazia no array.
        prkCliente = new Gerais().removePosicaoVazia(prkCliente);


        //Se o array for null não faz a request.
        if(prkCliente === null){
            return;
        }


        carregarDados('../controllers/ControllerCliente.php?acao=deletarVarios',
            'POST','&prkCliente='+prkCliente);

        var json = jsonDados;

        //Caso a reposta do back seja negativa exibe a mensagem de erro para o usuário.
        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }

        //Caso a resposta seja positiva lista novamente os clientes.
        this.listarCliente();



    };



}