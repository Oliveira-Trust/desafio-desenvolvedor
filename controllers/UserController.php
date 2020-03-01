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

            // Validações
            if (!isset($_POST['email']) || trim($_POST['email']) === '' || !isset($_POST['password']) || trim($_POST['password']) === '') {
                echo json_encode(['status' => '1', 'msg' => 'Favor, preencher o email e a senha.']);
                return;
            }

            // Pega os dados do login
            $field = ['name' => 'email', 'value' => $_POST['email']];
            $pass = sha1($_POST['password']);

            // Retorna os dados com base no email
            $findAll = $this->model->findAll($field, null);
            if (is_array($findAll) && count($findAll)) {
                    
                    // Checa se são válidos e atribui na session
                    if ($findAll[0]['password'] == $pass) {
                        $_SESSION['user']['id'] = $findAll[0]['id'];
                        $_SESSION['user']['name'] = $findAll[0]['name'];
                        $_SESSION['user']['email'] = $findAll[0]['email'];
                    
                    echo json_encode(['status' => '1', 'data' => $findAll]);
                    return;
                } else {
                    echo json_encode(['status' => '0', 'msg' => 'Login ou senha incorretos, tente novamente.']);
                    return;
                }
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        // Exibe os detalhes do registro selecionado
        public function show() {

            // Validações
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

        // Insere um novo registro
        public function store() {

            // Validações
            if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
                echo json_encode(['status' => '0', 'msg' => 'Erro ao recuperar informações do campo, tente novamente.']);
                return;
            }

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

        // Atualiza um registro
        public function update() {

            // Validações
            if (!isset($_POST['id']) ||!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password'])) {
                echo json_encode(['status' => '0', 'msg' => 'Erro ao recuperar informações do campo, tente novamente.']);
                return;
            }

            if (!isset($_POST['id']) || !is_numeric($_POST['id']) || $_POST['id'] == 0) {
                echo json_encode(['status' => '0', 'msg' => 'Id não possui um valor válido, tente novamente.']);
                return;
            }


            if (trim($_POST['name']) === '' || trim($_POST['email']) === '' || trim($_POST['password']) === '') {
                echo json_encode(['status' => '0', 'msg' => 'Os campos não podem ficar em branco.']);
                return;
            }

            $updateById = $this->model->updateById($_POST['id'], $_POST);
            if ($updateById) {
                echo json_encode(['status' => '1']);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        // Deleta um registro
        public function destroy() {

            // Validações
            if (!isset($_POST['id']) || !is_numeric($_POST['id']) || $_POST['id'] == 0) {
                echo json_encode(['status' => '0', 'msg' => 'Id não possui um valor válido, tente novamente.']);
                return;
            }

            $deleteById = $this->model->deleteById($_POST['id']);
            if ($deleteById) {
                echo json_encode(['status' => '1']);
                return;
            }

            echo json_encode(['status' => '0', 'msg' => 'Erro ao localizar registro, tente novamente.']);
        }

        // Deleta um ou vários registros selecionados
        public function destroySelected() {

            // Validações
            if(!isset($_POST['ids'])) {
                echo json_encode(['status' => '0', 'msg' => 'O valor dos registros não são válidos, tente novamente.']);
                return;
            }

            $deleteSelected = $this->model->deleteSelected($_POST['ids']);
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