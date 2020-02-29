<?php
    abstract class Model {

        public function __construct() {}
        
        // Define métodos abstratos para serem implementadas em subclasses de Model
        public abstract function findAll($field = null, $order);
        public abstract function findById($id);
        public abstract function insert($fields);
        public abstract function updateById($id, $fields);
        public abstract function deleteById($id);
        public abstract function deleteSelected($ids);

    }
?>