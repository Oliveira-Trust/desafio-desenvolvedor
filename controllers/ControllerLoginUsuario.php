<?php


include_once ('../controllers/Controller.php');
include_once('../models/ModelLoginUsuario.php');
include_once('../validations/ValidaLoginUsuario.php');

//controller filho
class ControllerLoginUsuario extends Controller
{
    //passa como parametro as instancias corretas a serem utilizadas pelo controller pai;
    public function __construct()
    {
        parent::__construct(new ModelLoginUsuario(), new ValidaLoginUsuario());
    }


    public function login(){

        $_SESSION['acessoPermitido'] = false;

        $statusValidacao =  $this->valida->login();


        if($statusValidacao['res'] == '0'){
            echo json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }


        $statusRequisicao = $this->model->login();



        if($statusRequisicao === false || empty($statusRequisicao)){
            echo json_encode(['res'=>'0','msg'=>'Login ou senha incorretos.']);
            return;
        }

        $_SESSION['acessoPermitido'] = true;


        echo json_encode(['res'=>'1']);
    }

    public function cadastrar(){

        $statusValidacao =  $this->valida->cadastrar();


        if($statusValidacao['res'] == '0'){
            echo json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }


        $statusRequisicao = $this->model->cadastrar();


        if($statusRequisicao === 'emailExistente'){
            echo json_encode(['res'=>'0','msg'=>'O email inserido já esta cadastrado. Por favor insira outro email.']);
            return;
        }


        if($statusRequisicao === false || empty($statusRequisicao)){
            echo json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao fazer o cadastro. Tente novamente']);
            return;
        }

        echo json_encode(['res'=>'1']);
        return;

    }

    public function deslogar(){

        unset($_SESSION['acessoPermitido']);

        echo json_encode(['res'=>'1']);
        return;
    }




}


//checa se a ação existe, se não exisitir retorna erro.
if(isset($_GET['acao']) and trim($_GET['acao']) != ''){

    $acao = $_GET['acao'];
    $obj = new ControllerLoginUsuario();
    $obj->$acao();

}else{
    echo json_encode(['res'=>'0', 'msg'=>'Ação não encontrada.']);
}