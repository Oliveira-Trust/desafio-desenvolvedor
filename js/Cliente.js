function Cliente() {



    this.listarCliente = function () {

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

                        html += '<td><button class="btn btn-primary" id="botaoAdiciona" value="editar"  ' +
                            'onclick="new Cliente().editarCliente('+jsonDados.dados[i].prkCliente+')">Editar</button></td>';

                        html += '<td><button class="btn btn-primary" id="botaoAdiciona" value="excluir" ' +
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



    };

    this.inserirCliente = function () {

        carregarDados('../controllers/ControllerCliente.php?acao=inserir');
        this.listarCliente();

    };

    this.deletarCliente = function ($prkCliente) {

        carregarDados('../controllers/ControllerCliente.php?acao=deletar',
            'POST','&prkCliente='+$prkCliente);

        var json = jsonDados;


        this.listarCliente();

    };

    this.editarCliente = function ($prkCliente) {

        carregarDados('../controllers/ControllerCliente.php?acao=editar');
        this.listarCliente();

    };
}