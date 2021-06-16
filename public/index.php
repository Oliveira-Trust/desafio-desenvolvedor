<?php

require __DIR__ . '/../vendor/autoload.php';

use Alura\Cursos\Controller\InterfaceControladorRequisicao;

$caminho = $_SERVER['PATH_INFO'];
$rotas = require __DIR__ . '/../config/routes.php'; //pega o arquivo rotas, onde tem return com as $rotas

//verifica se o caminho existe no arquivo de rotas, caso não existe exibe 404
if (!array_key_exists($caminho, $rotas)) {
    http_response_code(404);
    exit();
}

session_start();

//verifica se o session está definido como logado, se não estiver, redireciona para login
if (!isset($_SESSION['logado']) && $caminho !=='/login' && $caminho !=='/realiza-login') {
    header('Location: /login');
    exit();
}

$classeControladora = $rotas[$caminho];
/** @var InterfaceControladorRequisicao $controlador */
$controlador = new $classeControladora();
$controlador->processaRequisicao();
