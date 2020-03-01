<?php

    include_once(__DIR__ . '/Controller.php');
    include_once(__DIR__ . '/../models/PurchaseOrder.php');
    include_once(__DIR__ . '/../utils/functions.php');

    class PurchaseOrderController extends Controller {

        private $model;

        public function __construct() {
            $this->model = new PurchaseOrder();
        }
        
        // Lista todos os registros
        public function index() {

            $field = ['name' => 'name', 'value' => 'lll'];
            $order = ['fieldName' => 'id', 'orderType' => 'ASC'];

            $findAll = $this->model->findAll(null ,null);
            if (is_array($findAll) && count($findAll)) {
                echo json_encode(['status' => '1', 'data' => $findAll]);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        // Exibe os detalhes do registro selecionado
        public function show() {
            $findById = $this->model->findById(1);
            if (is_array($findById) && count($findById)) {
                echo json_encode(['status' => '1', 'data' => $findById]);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        public function store() {
            $arr['productId'] = '1';
            $arr['clientId'] = '1';
            $arr['qtd'] = '5';
            $arr['status'] = 'Pago';

            $insert = $this->model->insert($arr);
            if ($insert) {
                echo json_encode(['status' => '1']);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        public function update() {
            $arr['qtd'] = '5';
            $arr['status'] = 'Cancelado';

            $updateById = $this->model->updateById(1, $arr);
            if ($updateById) {
                echo json_encode(['status' => '1']);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        public function destroy() {
            $deleteById = $this->model->deleteById(2);
            if ($deleteById) {
                echo json_encode(['status' => '1']);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        public function destroySelected() {
            $deleteSelected = $this->model->deleteSelected([1, 3, 4]);
            if ($deleteSelected) {
                echo json_encode(['status' => '1']);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }
    }

    if (isLogged()) {
        // Pega a ação por get, verifica se existe o método no obj e caso não exista retorna erro
        $acao = (isset($_GET['acao'])) ? $_GET['acao'] : 'index';

        $obj = new PurchaseOrderController();
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