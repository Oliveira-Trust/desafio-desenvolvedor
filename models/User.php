<?php

    include_once(__DIR__ . '/Model.php');
    include_once(__DIR__ . '/../utils/Db.php');

    class User extends Model {

        private $conn;

        public function __construct() {
            $this->conn = Db::getConnection();
        }

        // Seleciona todos os registros da tabela
        public function findAll($field = null, $order){
            if ($this->conn !== false) {
                try {
                    $queryTxt = ($field === null) ? 'SELECT * FROM users' 
                                                : 'SELECT * FROM users WHERE '.$field['name'].' = :fieldValue';
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
                }
                catch(PDOException $e) {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Seleciona por ID
        public function findById($id){
            if ($this->conn !== false) {
                try {
                    $query = $this->conn->prepare('SELECT * FROM users WHERE id = :id');
                    $query->execute(['id' => $id]);
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    return $data;
                }
                catch(PDOException $e) {
                    return false;
                }
            } else {
                return false;
            }
        }

        // Insere um novo registro na tabela
        public function insert($fields){
            if ($this->conn !== false) {
                try {
                    $query = $this->conn->prepare('INSERT INTO users (name, email, password) values (:name, :email, :password)');
                    $query->execute(['name' => $fields['name'], 
                                    'email' => $fields['email'], 
                                    'password' => sha1($fields['password'])]);
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
                    $query = $this->conn->prepare('UPDATE users SET name = :name, email = :email, password = :password where id = :id');
                    $query->execute(['id' => $id, 
                                    'email' => $fields['email'],
                                    'name' => $fields['name'], 
                                    'password' => sha1($fields['password'])]);
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
                    $query = $this->conn->prepare('DELETE FROM users WHERE id = :id');
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
                    $this->conn->query('DELETE FROM users WHERE id IN ('.$ids.')');
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