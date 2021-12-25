<?php

$config = ['settings' => [
    'addContentLengthHeader' => false,
    'displayErrorDetails' => true
]];
$app = new \Slim\App($config);
// Carrega os containers de dependencias
require_once __DIR__ . '/../containers/containers.php';