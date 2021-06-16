<?php

namespace Alura\Cursos\Controller\CompraController;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Compra;
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

        if(is_null($id) || $id === false){
            $_SESSION['tipo_mensagem'] = 'danger';
            $_SESSION['mensagem'] = 'Compra inexistente';

            header('Location: /listar-compras');
            return;
        }

        $compra = $this->entityManager->getReference(Compra::class, $id);
        $this->entityManager->remove($compra);
        $this->entityManager->flush();
        $_SESSION['tipo_mensagem'] = 'success';
        $_SESSION['mensagem'] = 'Compra excluído com sucesso';

        header('Location: /listar-compras');
    }
}