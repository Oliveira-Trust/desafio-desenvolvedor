<?php

    include_once(__DIR__ . '/Controller.php');
    include_once(__DIR__ . '/../models/PurchaseOrder.php');

    class PurchaseOrderController extends Controller {

        private $model;

        public function __construct() {
            $this->model = new PurchaseOrder();
        }
        
        // Lista todos os registros
        public function index() {
            $findAll = $this->model->findAll(null,null);
            if (is_array($findAll) && count($findAll)) {
                echo json_encode(['status' => '1', 'data' => $findAll]);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }  

        // Exibe os detalhes do registro selecionado
        public function show() {
            
        }
    }

    // Pega a ação por get, verifica se existe o método no obj e caso não exista retorna erro
    $acao = (isset($_GET['acao'])) ? $_GET['acao'] : 'index';

    $obj = new PurchaseOrderController();
    if (method_exists($obj, $acao)) {
    $obj->$acao();
    } else {
        echo json_encode(['status' => 0, 'msg' => 'Não foi possível localizar a ação. Tente novamente']);
        return;
    }

?>