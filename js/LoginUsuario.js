function LoginUsuario(){


    this.login = function (){

        var formLogin =  $('#formLogin').serialize();


        carregarDados('../controllers/ControllerLoginUsuario.php?acao=login',
            'POST',formLogin);

        var json = jsonDados;

        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }

        window.location.replace("../view/index.php");

    };

    this.deslogar = function (){

        carregarDados('../controllers/ControllerLoginUsuario.php?acao=deslogar',
            'POST');

        var json = jsonDados;


        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }

        window.location.replace("../view/login.php");

    };

    this.cadastrar = function () {

        var formLogin =  $('#formCadastro').serialize();


        carregarDados('../controllers/ControllerLoginUsuario.php?acao=cadastrar',
            'POST',formLogin);

        var json = jsonDados;


        if(json.res == '0') {
            new Gerais().exibirMensagemErro(json.msg);
            return;
        }

        window.location.replace("../view/index.php");


    };
}