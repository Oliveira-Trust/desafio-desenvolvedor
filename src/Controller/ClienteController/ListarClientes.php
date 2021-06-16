<?php

namespace Alura\Cursos\Controller\ClienteController;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Cliente;
use Alura\Cursos\Infra\EntityManagerCreator;

class ListarClientes extends ControllerComHtml implements InterfaceControladorRequisicao
{
    private $repositorioDeClientes;

    public function __construct()
    {
        $entityManager = (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioDeClientes = $entityManager
            ->getRepository(Cliente::class);
    }

    public function processaRequisicao(): void
    {
        $this->renderizaHTML('cliente/listar-clientes.php', [
            'clientes' => $this->repositorioDeClientes->findAll(),
            'titulo' => 'Lista de Clientes',
        ]);
    }
}