<?php

    include_once(__DIR__ . '/Model.php');
    include_once(__DIR__ . '/../utils/Db.php');

    class PurchaseOrder extends Model {

        private $conn;

        public function __construct() {
            $this->conn = Db::getConnection();
        }

        // Seleciona todos os registros da tabela
        public function findAll($field, $orderBy){
            if ($this->conn !== false) {
                $query = $this->conn->prepare('SELECT * FROM purchaseOrder');
                $query->execute();
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            } else {
                return false;
            }
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