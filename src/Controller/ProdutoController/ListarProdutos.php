<?php

namespace Alura\Cursos\Controller\ProdutoController;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Produto;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarProdutos extends ControllerComHtml implements InterfaceControladorRequisicao
{
    private $repositorioDeProdutos;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioDeProdutos = $entityManager
            ->getRepository(Produto::class);
    }

    public function processaRequisicao(): void
    {
        $this->renderizaHTML('produto/listar-produtos.php', [
            'produtos' => $this->repositorioDeProdutos->findAll(),
            'titulo' => 'Lista de Produtos',
        ]);
    }
}