<?php 

// Define controller padrão
$controller = (isset($_GET['controller']) && file_exists(__DIR__ . '/controllers/'.$controller.'.php')) ? $_GET['controller'].'Controller' : 'PurchaseOrderController';

// Inclui arquivo
require_once(__DIR__ . '/controllers/'.$controller.'.php');

?>