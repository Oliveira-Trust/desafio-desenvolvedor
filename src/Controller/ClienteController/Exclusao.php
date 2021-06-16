<?php

namespace Alura\Cursos\Controller\ClienteController;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Cliente;
use Alura\Cursos\Infra\EntityManagerCreator;

class Exclusao implements InterfaceControladorRequisicao
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT);

        //Caso o cliente não tenha um id válido, retorna para listar clientes
        if( is_null($id) || $id === false){
            $_SESSION['tipo_mensagem'] = 'danger';
            $_SESSION['mensagem'] = 'Cliente inexistente';

            header('Location: /listar-clientes');
            return;
        }

        $cliente = $this->entityManager->getReference(Cliente::class, $id);
        $this->entityManager->remove($cliente);
        $this->entityManager->flush();
        $_SESSION['tipo_mensagem'] = 'success';
        $_SESSION['mensagem'] = 'Cliente excluído com sucesso';

        header('Location: /listar-clientes');
    }
}