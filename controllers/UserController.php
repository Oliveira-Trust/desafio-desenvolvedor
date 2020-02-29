<?php

    include_once(__DIR__ . '/Controller.php');
    include_once(__DIR__ . '/../models/User.php');

    class UserController extends Controller {

        private $model;

        public function __construct() {
            $this->model = new Product();
        }
        
        // Lista todos os registros
        public function index() {
            echo json_encode(['status' => '1', 'msg' => 'Sucesso!']);
            return;
        }

        // Exibe os detalhes do registro selecionado
        public function show() {
            
        }
    }

    // Pega a ação por get, verifica se existe o método no obj e caso não exista retorna erro
    $acao = (isset($_GET['acao'])) ? $_GET['acao'] : 'index';

    $obj = new UserController();
    if (method_exists($obj, $acao)) {
    $obj->$acao();
    } else {
        echo json_encode(['status' => 0, 'msg' => 'Não foi possível localizar a ação. Tente novamente']);
        return;
    }

?>