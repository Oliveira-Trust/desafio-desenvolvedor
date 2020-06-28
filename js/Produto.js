function Produto() {



    this.listarProduto = function () {

        carregarDados('../controllers/ControllerProduto.php?acao=listar','POST');

        this.limpaTabela();

        var json = jsonDados;

        var html =  '<table id="tabelaProdutos"  class="table"  style="width:100%">'+
            '<thead>'+
            '<tr>'+
            '<th >id</th>'+
            '<th >Produto</th>'+
            '<th >Preco</th>'+
            '<th ></th>'+
            '<th ></th>'+
            '</tr>'+
            '</thead>'+
            '<tbody>';

        for(var i in jsonDados.dados){
            html += '<tr>';
            html += '<th scope="row">'+jsonDados.dados[i].prkProduto+'</th>';

            html += '<td>'+jsonDados.dados[i].nomeProduto+'</td>';

            html += '<td>'+jsonDados.dados[i].precoProduto+'</td>';

            html += '<td><button class="btn btn-primary" id="botaoAdiciona" value="editar"  ' +
                'onclick="new Produto().abreModalEditarGenerico(\''+jsonDados.dados[i].nomeCliente+'\' , '+jsonDados.dados[i].prkCliente+');">Editar</button></td>';

            html += '<td><button class="btn btn-primary" id="botaoAdiciona" value="excluir" ' +
                'onclick="new Produto().deletarProduto('+jsonDados.dados[i].prkProduto+')">Excluir</button></td>';



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
                }

            ]
        });
        $("#nomeTabelaAtual").html('Produtos');
        $("#abreModal").html('Inserir novo produto');

        this.montaModalEditarProduto();

    };

    this.inserirProduto = function () {


    };

    this.deletarProduto = function (prkProduto) {

        carregarDados('../controllers/ControllerProduto.php?acao=deletar',
            'POST','&prkProduto='+prkProduto);

        var json = jsonDados;


        this.listarProduto();


    };

    this.editarProduto = function () {


    };

    this.limpaTabela = function (){

        document.querySelectorAll('#tabelaPrincipal')[0].children[0].remove();

    };

    this.montaModalEditarProduto= function (){

        var form =  document.querySelectorAll('#formularioModalGenerico')[0].firstChild;

        if(form !== undefined){
            form.remove();
        }

        var html =  '<form id="formModalEditarProduto">'+
            '<div class="form-group">'+
            '<label for="recipient-name" class="col-form-label">Nome do produto</label>'+
            '<input type="text" class="form-control" id="editarNomeProduto" name="editarNomeProduto">'+
            '</div>'+
            '</form>';

        $('#formularioModalGenerico').html(html);

    }
}