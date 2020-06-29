function login(){


    this.loginCliente = function (){

        var formLogin =  $('#formLogin').serialize();


        carregarDados('../controllers/ControllerLogin.php?acao=login',
            'POST',formLogin);

        var json = jsonDados;

        if(json.res == '1'){
            window.location.replace("../view/index.php");
        }
    };

    this.deslogarCliente = function (){

        carregarDados('../controllers/ControllerLogin.php?acao=deslogar',
            'POST');

        var json = jsonDados;

        if(json.res == '1'){
            window.location.replace("../view/login.php");
        }
    }

    this.cadastrar = function () {

        var formLogin =  $('#formCadastro').serialize();


        carregarDados('../controllers/ControllerLogin.php?acao=cadastrar',
            'POST',formLogin);

        var json = jsonDados;

        if(json.res == '1'){
            window.location.replace("../view/index.php");
        }

    }
}