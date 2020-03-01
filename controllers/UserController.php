<?php

    include_once(__DIR__ . '/Controller.php');
    include_once(__DIR__ . '/../models/User.php');
    include_once(__DIR__ . '/../utils/functions.php');

    class UserController extends Controller {

        private $model;

        public function __construct() {
            $this->model = new User();
        }
        
        // Lista todos os registros
        public function index() {

            if (!isset($_POST['email']) || trim($_POST['email']) === '' || !isset($_POST['password']) || trim($_POST['password']) === '') {
                echo json_encode(['status' => '1', 'msg' => 'Favor, preencher o email e a senha.']);
                return;
            }

            $field = ['name' => 'email', 'value' => $_POST['email']];
            $order = ['fieldName' => 'id', 'orderType' => 'ASC'];
            $pass = sha1($_POST['password']);

            $findAll = $this->model->findAll($field, null);
            if (is_array($findAll) && count($findAll)) {
                if ($findAll[0]['password'] == $pass) {
                    $_SESSION['user']['id'] = $findAll[0]['id'];
                    $_SESSION['user']['name'] = $findAll[0]['name'];
                    $_SESSION['user']['email'] = $findAll[0]['email'];
                }
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
            if (trim($_POST['name']) === '' || trim($_POST['email']) === '' || trim($_POST['password']) === '') {
                echo json_encode(['status' => '0', 'msg' => 'Os campos não podem ficar em branco.']);
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
            $arr['name'] = 'Test22e';
            $arr['email'] = 'teste22e@teste.com';
            $arr['password'] = '12345678';

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

    // Pega a ação por get, verifica se existe o método no obj e caso não exista retorna erro
    $acao = (isset($_GET['acao'])) ? $_GET['acao'] : 'index';

    $obj = new UserController();
    if (method_exists($obj, $acao)) {
        $obj->$acao();
    } else {
        echo json_encode(['status' => '0', 'msg' => 'Não foi possível localizar a ação. Tente novamente']);
        return;
    }

?>