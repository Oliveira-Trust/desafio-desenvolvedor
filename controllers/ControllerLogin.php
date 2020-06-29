<?php


include_once ('../controllers/Controller.php');
include_once ('../models/ModelLogin.php');
include_once ('../controllers/ValidaLogin.php');

class ControllerLogin extends Controller
{

    public function __construct()
    {
        parent::__construct(new modelLogin(), new validaLogin());
    }


}



if(isset($_GET['acao']) and trim($_GET['acao']) != ''){

    $acao = $_GET['acao'];
    $obj = new ControllerLogin();
    $obj->$acao();

}else{
    echo json_encode(['res'=>'0', 'msg'=>'Ação não encontrada.']);
}