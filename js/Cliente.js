function Cliente() {

    this.init = function () {
        var primeiraVez = true;

        this.listarCliente(primeiraVez);
        this.montaModalInserirCliente();
        this.montaModalEditarCliente();
    };

    this.listarCliente = function (primeiraVez = false) {

        carregarDados('../controllers/ControllerCliente.php?acao=listar','POST');


        var json = jsonDados;

        var html =  '<table id="tabelaClientes"  class="table"  style="width:100%">'+
                    '<thead>'+
                        '<tr>'+
                        '<th >id</th>'+
                        '<th >nome</th>'+
                        '<th ></th>'+
                        '<th ></th>'+
                        '</tr>'+
                    '</thead>'+
                     '<tbody>';

                    for(var i in jsonDados.dados){
                        html += '<tr>';
                        html += '<th scope="row">'+jsonDados.dados[i].prkCliente+'</th>';

                        html += '<td>'+jsonDados.dados[i].nomeCliente+'</td>';

                        html += '<td><button class="btn btn-primary"  value="editar"  ' +
                            'onclick="new Cliente().abreModalEditarCliente(\''+jsonDados.dados[i].nomeCliente+'\' , '+jsonDados.dados[i].prkCliente+');">Editar</button></td>';

                        html += '<td><button class="btn btn-primary"  value="excluir" ' +
                            'onclick="new Cliente().deletarCliente('+jsonDados.dados[i].prkCliente+')">Excluir</button></td>';

                        html += '</tr>';

                    }
                    html += '</tbody>';

                    $("#tabelaPrincipal").html(html);
                    $("#tabelaClientes").DataTable({
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
                                }

                            ]
                    });
                    $("#nomeTabelaAtual").html('Clientes');
                    $("#abreModal").html('Inserir novo cliente');


                    this.limpaModalEditar(primeiraVez);
                    this.limpaModalInserir(primeiraVez);
                    this.montaModalInserirCliente();
                    this.montaModalEditarCliente();



    };

    this.inserirCliente = function () {

        var form = $('#modalInserirGenerico #formModalInserirCliente').serialize();


        carregarDados('../controllers/ControllerCliente.php?acao=inserir',
            'POST',form);

        var json = jsonDados;


        if(json.res == '1'){
            $('#modalInserirGenerico').modal('toggle');
            this.listarCliente();
        }


    };

    this.deletarCliente = function (prkCliente) {

        carregarDados('../controllers/ControllerCliente.php?acao=deletar',
            'POST','&prkCliente='+prkCliente);

        var json = jsonDados;


        this.listarCliente();

    };

    this.editarCliente = function (prkCliente) {

        var nomeCliente = $('#editarNomeCliente').val();

        carregarDados('../controllers/ControllerCliente.php?acao=editar',
            'POST','&prkCliente='+prkCliente+'&nomeCliente='+nomeCliente);

        var json = jsonDados;

        if(json.res == '1'){
            $('#modalEditarGenerico').modal('toggle');
            this.listarCliente();
        }

    };

    this.montaModalInserirCliente = function () {


        var html =  '<form id="formModalInserirCliente">'+
                    '<div class="form-group">'+
                    '<label for="recipient-name" class="col-form-label">Nome do Cliente</label>'+
                    '<input type="text" class="form-control" id="nomeCliente" name="nomeCliente">'+
                    '</div>'+
                    '</form>';



        $('#modalInserirGenerico #formularioModalInserirGenerico').html(html);
        $('#labelModalInserirGenerico').html('Novo Cliente');
        $('#modalInserirGenerico #botaoSalvarModal').attr("onClick" ,"new Cliente().inserirCliente()");

    };

    this.montaModalEditarCliente = function (){

        var html =  '<form id="formModalEditarCliente">'+
            '<div class="form-group">'+
            '<label for="recipient-name" class="col-form-label">Nome do cliente</label>'+
            '<input type="text" class="form-control" id="editarNomeCliente" name="nomeCliente">'+
            '</div>'+
            '</form>';

         $('#formularioModalEditarGenerico').html(html);
         $('#modalEditarGenericoLabel').html('Editar cliente');

    };

    this.limpaModalInserir = function(primeiraVez){

        var form =  document.querySelectorAll('#formularioModalInserirGenerico')[0].firstChild;

        if(primeiraVez === true){
            return;
        }

        form.remove();

    };


    this.limpaModalEditar = function(primeiraVez){

        var form =  document.querySelectorAll('#formularioModalEditarGenerico')[0].firstChild;

        if(primeiraVez === true){
            return;
        }

        form.remove();

    };


    this.abreModalEditarCliente = function (nomeCliente, prkCliente) {
        $('#modalEditarGenerico #editarNomeCliente').val(nomeCliente);
        $('#modalEditarGenerico #botaoSalvaAlteracoesModal').attr("onClick" ,"new Cliente().editarCliente("+prkCliente+")");
        $("#modalEditarGenerico").modal();
    };


}