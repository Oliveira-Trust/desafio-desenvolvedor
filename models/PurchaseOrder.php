<?php

    include_once(__DIR__ . '/Model.php');
    include_once(__DIR__ . '/../utils/Db.php');

    class PurchaseOrder extends Model {

        private $conn;

        public function __construct() {
            $this->conn = Db::getConnection();
        }

        // Seleciona todos os registros da tabela
        public function findAll($field = null, $order){
            if ($this->conn !== false) {
                try {
                    $join = 'INNER JOIN clients c ON c.id = po.clientId ';
                    $join .= 'INNER JOIN products p ON p.id = po.productId';

                    $filterClause = (isset($field['name']) && $field['name'] == 'totalPrice') ? 'HAVING' : 'WHERE';


                    $queryTxt = ($field === null) ? "SELECT po.id, po.qtd, po.status, c.name AS clientName, p.name AS productName, p.price,
                                                            (p.price * po.qtd) AS totalPrice, p.id AS productId, c.id AS clientId 
                                                        FROM purchaseorder po $join" 
                                                : 'SELECT po.id, po.qtd, po.status, c.name AS clientName, p.name AS productName, p.price,
                                                          (p.price * po.qtd) AS totalPrice, p.id AS productId, c.id AS clientId 
                                                        FROM purchaseorder po '.$join.' '.$filterClause.' '.$field['name'].' = :fieldValue';
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
                    $join = 'INNER JOIN clients c ON c.id = po.clientId ';
                    $join .= 'INNER JOIN products p ON p.id = po.productId';

                    $query = $this->conn->prepare("SELECT po.qtd, po.status, c.name AS clientName, p.name AS productName, p.price,
                                                   (p.price * po.qtd) as totalPrice, p.id AS productId, c.id AS clientId FROM purchaseorder po $join WHERE po.id = :id");
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
                    $query = $this->conn->prepare('INSERT INTO purchaseorder (clientId, productId, qtd, status) 
                                                    VALUES (:clientId, :productId, :qtd, :status)');
                    $query->execute(['clientId' => $fields['clientId'], 
                                    'productId' => $fields['productId'], 
                                    'qtd' => $fields['qtd'],
                                    'status' => $fields['status']]);
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
                    $query = $this->conn->prepare('UPDATE purchaseorder SET qtd = :qtd, status = :status, 
                                                clientId = :clientId, productId = :productId WHERE id = :id');
                    $query->execute(['id' => $id, 'qtd' => $fields['qtd'], 'status' => $fields['status'],
                                    'clientId' => $fields['clientId'], 'productId' => $fields['productId']]);
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
                    $query = $this->conn->prepare('DELETE FROM purchaseorder WHERE id = :id');
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
                    $this->conn->query('DELETE FROM purchaseorder WHERE id IN ('.implode(',', $ids).')');
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