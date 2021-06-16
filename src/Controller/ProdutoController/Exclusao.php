<?php

namespace Alura\Cursos\Controller\ProdutoController;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Produto;
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

        if( is_null($id) || $id === false){
            $_SESSION['tipo_mensagem'] = 'danger';
            $_SESSION['mensagem'] = 'Produto inexistente';

            header('Location: /listar-produtos');
            return;
        }


        $produto = $this->entityManager->getReference(Produto::class, $id);
        $this->entityManager->remove($produto);
        $this->entityManager->flush();
        $_SESSION['tipo_mensagem'] = 'success';
        $_SESSION['mensagem'] = 'Produto excluído com sucesso';

        header('Location: /listar-produtos');
    }
}