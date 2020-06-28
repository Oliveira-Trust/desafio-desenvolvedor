function Cliente() {



    this.listarCliente = function () {

        carregarDados('../controllers/ControllerCliente.php?acao=listar','POST');


        var json = jsonDados;


        //monta a tabela de clientes




    };

    this.inserirCliente = function () {

        carregarDados('../controllers/ControllerCliente.php?acao=inserir');

    };

    this.deletarCliente = function () {

        carregarDados('../controllers/ControllerCliente.php?acao=deletar');

    };

    this.editarCliente = function () {

        carregarDados('../controllers/ControllerCliente.php?acao=editar');

    };
}