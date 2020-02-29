<?php

    include_once(__DIR__ . '/Model.php');
    include_once(__DIR__ . '/../utils/Db.php');

    class Login extends Model {

        private $conn;

        public function __construct() {
            $this->conn = Db::getConnection();
        }

        // Seleciona todos os registros da tabela
        public function findAll($field, $orderBy){

        }

        // Seleciona por ID
        public function findById($id){

        }

        // Insere um novo registro na tabela
        public function insert($fields){

        }

        // Atualiza o registro por ID
        public function updateById($id, $fields){

        }

        // Deleta registro da tabela por ID
        public function deleteById($id){

        }

        // Deleta registros em massa usando vários IDs
        public function deleteSelected($ids){

        }

    }

?>