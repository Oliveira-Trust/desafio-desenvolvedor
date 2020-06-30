<?php


include_once ('../controllers/Controller.php');
include_once ('../models/ModelPedido.php');
include_once ('../controllers/ValidaPedido.php');

class ControllerPedido extends Controller{


    public function __construct()
    {
        parent::__construct(new modelPedido(), new validaPedido());
    }





}


if(isset($_GET['acao']) and trim($_GET['acao']) != ''){

    $acao = $_GET['acao'];
    $obj = new ControllerPedido();
    $obj->$acao();

}else{
    echo json_encode(['res'=>'0', 'msg'=>'Ação não encontrada.']);
}