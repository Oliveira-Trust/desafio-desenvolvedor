<?php
header('Content-Type: application/json');

require '../../vendor/autoload.php';
require '../controllers/ConversionController.php';

use App\Controllers\ConversionController;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $destinyCoin = $_POST['destinyCoin'];
    $amount = $_POST['amount'];
    $paymentMethod = $_POST['paymentMethod'];

    if ($amount > 1000 && $amount < 100000) {
        $controller = new ConversionController();

        $response = $controller->convert($destinyCoin, $amount, $paymentMethod);
    } else {
        $response = [
            'success' => false,
            'message' => 'O valor deve ser entre R$ 1.000,00 e R$ 100.000,00.'
        ];
    }
    echo json_encode($response);
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Método não permitido']);
}