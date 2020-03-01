<?php

    include_once(__DIR__ . '/Controller.php');
    include_once(__DIR__ . '/../models/Product.php');
    include_once(__DIR__ . '/../utils/functions.php');

    class ProductController extends Controller {

        private $model;

        public function __construct() {
            $this->model = new Product();
        }
        
        // Lista todos os registros
        public function index() {

            $field = (!isset($_POST['fieldFilter']) || $_POST['fieldFilter'] == 'Selecione'|| !isset($_POST['fieldValue']) || trim($_POST['fieldValue']) === '') 
                        ? null : ['name' => $_POST['fieldFilter'], 'value' => $_POST['fieldValue']];
            
            $order = (!isset($_POST['fieldOrder']) || $_POST['fieldOrder'] == 'Selecione'|| !isset($_POST['orderType']) || $_POST['orderType'] === 'Selecione') 
            ? null : ['fieldName' => $_POST['fieldOrder'], 'orderType' => $_POST['orderType']]; 
        

            $findAll = $this->model->findAll($field, $order);
            if (is_array($findAll) && count($findAll)) {
                echo json_encode(['status' => '1', 'data' => $findAll]);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        // Exibe os detalhes do registro selecionado
        public function show() {

            if (!isset($_POST['id']) || !is_numeric($_POST['id']) || $_POST['id'] == 0) {
                echo json_encode(['status' => '0', 'msg' => 'Id não possui um valor válido, tente novamente.']);
                return;
            }

            $findById = $this->model->findById($_POST['id']);
            if (is_array($findById) && count($findById)) {
                echo json_encode(['status' => '1', 'data' => $findById]);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        public function store() {

            if (!isset($_POST['name']) || trim($_POST['name']) === '') {
                echo json_encode(['status' => '0', 'msg' => 'Nome do produto inválido, tente novamente.']);
                return;
            }

            if (!isset($_POST['price'])) {
                echo json_encode(['status' => '0', 'msg' => 'Preço inválido, tente novamente.']);
                return;
            }

            $_POST['price'] = str_replace(',', '.', $_POST['price']);

            if (!is_numeric($_POST['price'])) {
                echo json_encode(['status' => '0', 'msg' => 'Preço inválido, tente novamente.']);
                return;
            }

            $insert = $this->model->insert($_POST);
            if ($insert) {
                echo json_encode(['status' => '1']);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        public function update() {

            if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
                echo json_encode(['status' => '0', 'msg' => 'Id inválido, tente novamente.']);
                return;
            }

            if (!isset($_POST['name']) || trim($_POST['name']) === '') {
                echo json_encode(['status' => '0', 'msg' => 'Nome do produto inválido, tente novamente.']);
                return;
            }

            if (!isset($_POST['price'])) {
                echo json_encode(['status' => '0', 'msg' => 'Preço inválido, tente novamente.']);
                return;
            }

            $_POST['price'] = str_replace(',', '.', $_POST['price']);

            if (!is_numeric($_POST['price'])) {
                echo json_encode(['status' => '0', 'msg' => 'Preço inválido, tente novamente.']);
                return;
            }

            $updateById = $this->model->updateById($_POST['id'], $_POST);
            if ($updateById) {
                echo json_encode(['status' => '1']);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        public function destroy() {

            if (!isset($_POST['id']) || empty($_POST['id']) || !is_numeric($_POST['id'])) {
                echo json_encode(['status' => '0', 'msg' => 'O valor do registro não é válido, tente novamente.']);
                return;
            }
            
            $deleteById = $this->model->deleteById($_POST['id']);
            if ($deleteById === true) {
                echo json_encode(['status' => '1']);
                return;
            } else if ($deleteById == -1) {
                echo json_encode(['status' => '0', 'msg' => 'Não é possível deletar produtos vinculados a um pedido de compra.']);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        public function destroySelected() {

            if(!isset($_POST['ids'])) {
                echo json_encode(['status' => '0', 'msg' => 'O valor dos registros não são válidos, tente novamente.']);
                return;
            }

            $deleteSelected = $this->model->deleteSelected($_POST['ids']);
            if ($deleteSelected === true) {
                echo json_encode(['status' => '1']);
                return;
            } else if ($deleteSelected == -1) {
                echo json_encode(['status' => '0', 'msg' => 'Não é possível deletar produtos vinculados a um pedido de compra.']);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }
    }

    if (isLogged()) {
        // Pega a ação por get, verifica se existe o método no obj e caso não exista retorna erro
        $acao = (isset($_GET['acao'])) ? $_GET['acao'] : 'index';

        $obj = new ProductController();
        if (method_exists($obj, $acao)) {
            $obj->$acao();
        } else {
            echo json_encode(['status' => '0', 'msg' => 'Não foi possível localizar a ação. Tente novamente']);
            return;
        }
    } else {
        echo json_encode(['status' => '2', 'msg' => 'Erro! Página restrita a usuários logados.']);
        return;
    }
?>