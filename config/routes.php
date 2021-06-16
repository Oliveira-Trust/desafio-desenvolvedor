<?php

use Alura\Cursos\Controller\ClienteController;
use Alura\Cursos\Controller\CompraController\FormularioInsercao;
use Alura\Cursos\Controller\CompraController\ListarCompras;
use Alura\Cursos\Controller\Deslogar;
use Alura\Cursos\Controller\FormularioLogin;
use Alura\Cursos\Controller\PrincipalController;
use Alura\Cursos\Controller\ProdutoController\Exclusao;
use Alura\Cursos\Controller\ProdutoController\FormularioEdicao;
use Alura\Cursos\Controller\ProdutoController\ListarProdutos;
use Alura\Cursos\Controller\ProdutoController\Persistencia;
use Alura\Cursos\Controller\RealizarLogin;

return array(
   '/login' => FormularioLogin::class,
    '/realiza-login' => RealizarLogin::class,
    '/logout' => Deslogar::class,
    '/principal' => PrincipalController::class,
    '/listar-clientes' =>ClienteController\ListarClientes::class,
    '/novo-cliente' => Alura\Cursos\Controller\ClienteController\FormularioInsercao::class,
    '/salvar-cliente' =>ClienteController\Persistencia::class,
    '/excluir-cliente'=>ClienteController\Exclusao::class,
    '/alterar-cliente'=> ClienteController\FormularioEdicao::class,
    '/listar-produtos'=> ListarProdutos::class,
    '/novo-produto' =>Alura\Cursos\Controller\ProdutoController\FormularioInsercao::class,
    '/salvar-produto'=> Persistencia::class,
    '/excluir-produto'=> Exclusao::class,
    '/alterar-produto'=> FormularioEdicao::class,
    '/listar-compras'=> ListarCompras::class,
    '/novo-compra'=> FormularioInsercao::class,
    '/salvar-compra'=>\Alura\Cursos\Controller\CompraController\Persistencia::class,
    '/excluir-compra'=>\Alura\Cursos\Controller\CompraController\Exclusao::class,
    '/alterar-compra'=>\Alura\Cursos\Controller\CompraController\FormularioEdicao::class
);