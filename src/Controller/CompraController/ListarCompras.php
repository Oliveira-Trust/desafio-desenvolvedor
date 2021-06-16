<?php

namespace Alura\Cursos\Controller\CompraController;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Compra;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarCompras extends ControllerComHtml implements InterfaceControladorRequisicao
{
    private $repositorioDeCompras;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioDeCompras = $entityManager
            ->getRepository(Compra::class);
    }

    public function processaRequisicao(): void
    {
        $this->renderizaHTML('compra/listar-compras.php', [
            'compras' => $this->repositorioDeCompras->findAll(),
            'titulo' => 'Lista de Compras',
        ]);
    }
}