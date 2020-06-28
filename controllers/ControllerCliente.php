<?php



include_once ('../controllers/Controller.php');
include_once ('../models/ModelCliente.php');
include_once ('../controllers/ValidaCliente.php');

class ControllerCliente extends Controller{




    public function __construct()
    {
        parent::__construct(new modelCliente(), new validaCliente());
    }


}



if(isset($_GET['acao']) and trim($_GET['acao']) != ''){

    $acao = $_GET['acao'];
    $obj = new ControllerCliente();
    $obj->$acao();

}else{
  echo json_encode(['msg'=>'Ação não encontrada.']);
}
