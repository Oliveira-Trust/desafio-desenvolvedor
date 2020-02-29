<?php

    include_once(__DIR__ . '/Model.php');
    include_once(__DIR__ . '/../utils/Db.php');

    class Client extends Model {

        private $conn;

        public function __construct() {
            $this->conn = Db::getConnection();
        }

        // Seleciona todos os registros da tabela
        public function findAll($field = null, $order){
            if ($this->conn !== false) {
                $queryTxt = ($field === null) ? 'SELECT * FROM clients' 
                                              : 'SELECT * FROM clients WHERE '.$field['name'].' = :fieldValue';
                if ($order !== null) {
                    $queryTxt .= ' ORDER BY '.$order['fieldName']. ' '.$order['orderType'];
                }
                $arr = [];
                if ($field !== null) {
                    $arr = ['fieldValue' => $field['value']];
                }

                $query = $this->conn->prepare($queryTxt);
                $query->execute($arr);
                $data = $query->fetchAll(PDO::FETCH_ASSOC);
                return $data;
            } else {
                return false;
            }
        }

        // Seleciona por ID
        public function findById($id){
            if ($this->conn !== false) {
                $query = $this->conn->prepare('SELECT * FROM clients WHERE id = :id');
                $query->execute(['id' => $id]);
                $data = $query->fetch(PDO::FETCH_ASSOC);
                return $data;
            } else {
                return false;
            }
        }

        // Insere um novo registro na tabela
        public function insert($fields){
            if ($this->conn !== false) {
                try {
                    $query = $this->conn->prepare('INSERT INTO clients (name, email) values (:name, :email)');
                    $query->execute(['name' => $fields['name'], 'email' => $fields['email']]);
                    return true;
                }
                catch(PDOException $e) {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Atualiza o registro por ID
        public function updateById($id, $fields){
            if ($this->conn !== false) {
                try {
                    $query = $this->conn->prepare('UPDATE clients SET name = :name, email = :email where id = :id');
                    $query->execute(['id' => $id, 'name' => $fields['name'], 'email' => $fields['email']]);
                    return true;
                }
                catch(PDOException $e) {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Deleta registro da tabela por ID
        public function deleteById($id){
            if ($this->conn !== false) {
                try {
                    $query = $this->conn->prepare('DELETE FROM clients WHERE id = :id');
                    $query->execute(['id' => $id]);
                    return true;
                }
                catch(PDOException $e) {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Deleta registros em massa usando vários IDs
        public function deleteSelected($ids){
            if ($this->conn !== false) {
                try {
                    $this->conn->query('DELETE FROM clients WHERE id IN ('.implode(',', $ids).')');
                    return true;
                }
                catch(PDOException $e) {
                    return false;
                }
            } else {
                return false;
            }
        }
        
    }

?>