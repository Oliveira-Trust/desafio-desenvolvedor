<?php


include_once ('../controllers/Controller.php');
include_once ('../models/ModelProduto.php');
include_once ('../validations/ValidaProduto.php');

//controller filho
class ControllerProduto extends Controller
{
    //passa como parametro as instancias corretas a serem utilizadas pelo controller pai;
    public function __construct()
    {
        parent::__construct(new modelProduto(), new validaProduto());
    }



}



//checa se a ação existe, se não exisitir retorna erro.
if(isset($_GET['acao']) and trim($_GET['acao']) != ''){

    $acao = $_GET['acao'];
    $obj = new ControllerProduto();
    $obj->$acao();

}else{
   echo json_encode(['msg'=>'Ação não encontrada.']);
}