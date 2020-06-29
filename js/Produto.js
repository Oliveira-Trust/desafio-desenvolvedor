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

            html += '<td><button class="btn btn-primary" value="editar"  ' +
                'onclick="new Produto().abreModalEditarProduto(\''+jsonDados.dados[i].nomeProduto+'\' ' +
                ', '+jsonDados.dados[i].prkProduto+' , '+jsonDados.dados[i].precoProduto+');">Editar</button></td>';

            html += '<td><button class="btn btn-primary"  value="excluir" ' +
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



        this.limpaModalInserir();
        this.limpaModalEditar();
        this.montaModalEditarProduto();
        this.montaModalInserirProduto();

    };

    this.inserirProduto = function () {

        var form = $('#modalInserirGenerico #formModalInserirProduto').serialize();


        carregarDados('../controllers/ControllerProduto.php?acao=inserir',
            'POST',form);

        var json = jsonDados;


        if(json.res == '1'){
            $('#modalInserirGenerico').modal('toggle');
            this.listarProduto();
        }



    };

    this.deletarProduto = function (prkProduto) {

        carregarDados('../controllers/ControllerProduto.php?acao=deletar',
            'POST','&prkProduto='+prkProduto);

        var json = jsonDados;


        this.listarProduto();


    };

    this.editarProduto = function (prkProduto) {

        var nomeProduto = $('#editarNomeProduto').val();
        var precoProduto = $('#editarPrecoProduto').val();

        carregarDados('../controllers/ControllerProduto.php?acao=editar',
            'POST','&prkProduto='+prkProduto+'&nomeProduto='+nomeProduto+'&precoProduto='+precoProduto);

        var json = jsonDados;

        if(json.res == '1'){
            $('#modalEditarGenerico').modal('toggle');
            this.listarProduto();
        }


    };

    this.limpaTabela = function (){

        document.querySelectorAll('#tabelaPrincipal')[0].children[0].remove();

    };

    this.montaModalInserirProduto= function (){

        var html =  '<form id="formModalInserirProduto">'+
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

        var html =  '<form id="formModalEditarProduto">'+
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


    this.limpaModalInserir = function() {
        var form =  document.querySelectorAll('#formularioModalInserirGenerico')[0].firstChild;

        if(form !== undefined){
            form.remove();
        }
    };

    this.limpaModalEditar = function() {
        var form =  document.querySelectorAll('#formularioModalEditarGenerico')[0].firstChild;

        if(form !== undefined){
            form.remove();
        }
    };


    this.abreModalEditarProduto = function (nomeProduto,prkProduto,precoProduto) {
        $('#modalEditarGenerico #editarNomeProduto').val(nomeProduto);
        $('#modalEditarGenerico #editarPrecoProduto').val(precoProduto);
        $('#modalEditarGenerico #botaoSalvaAlteracoesModal').attr("onClick" ,"new Produto().editarProduto("+prkProduto+")");
        $("#modalEditarGenerico").modal();
    }


}