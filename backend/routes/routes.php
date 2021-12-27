<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

require_once __DIR__ . '/configRoutes.php';

$app->get('/moedas', HomeController::class . ':index');
$app->get('/moeda/{code}', HomeController::class . ':getCurrency');

$app->get('/payments', PaymentController::class . ':index');
$app->post('/payment/save', PaymentController::class . ':store');

$app->post('/conversion/{userId}', TransactionController::class . ':exchange');

$app->get('/users', UserController::class . ':index');
$app->post('/users/delete/{id}', UserController::class . ':destroy');
$app->post('/users/update/{id}', UserController::class . ':update');
$app->post('/singup', UserController::class . ':store');
$app->post('/singin', UserController::class . ':login');

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});