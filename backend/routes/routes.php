<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

require_once __DIR__ . '/configRoutes.php';

$app->get('/', HomeController::class . ':index');

$app->get('/users', UserController::class . ':index');
$app->post('/users', UserController::class . ':store');
$app->delete('/users', UserController::class . ':destroy');
$app->put('/users', UserController::class . ':update');

$app->post('/users', UserController::class . ':login');