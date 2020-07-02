<?php


include_once ('../controllers/Controller.php');
include_once ('../models/ModelProduto.php');
include_once ('../validations/ValidaProduto.php');

class ControllerProduto extends Controller
{

    public function __construct()
    {
        parent::__construct(new modelProduto(), new validaProduto());
    }



}




if(isset($_GET['acao']) and trim($_GET['acao']) != ''){

    $acao = $_GET['acao'];
    $obj = new ControllerProduto();
    $obj->$acao();

}else{
   echo json_encode(['msg'=>'Ação não encontrada.']);
}