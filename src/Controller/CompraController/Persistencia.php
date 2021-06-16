<?php

namespace Alura\Cursos\Controller\CompraController;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Compra;
use Alura\Cursos\Infra\EntityManagerCreator;

class Persistencia implements InterfaceControladorRequisicao
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = (new EntityManagerCreator())
            ->getEntityManager();
    }

    public function processaRequisicao(): void
    {
        $nome = filter_input(
            INPUT_POST,
            'nome',
            FILTER_SANITIZE_STRING
        );

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        $statusCompra = filter_input(
            INPUT_GET,
            'statusCompra',
            FILTER_VALIDATE_INT
        );

        $compra = new Compra();
        $compra->setNome($_POST['nome']);
        $compra->setStatusDaCompra($_POST['statusCompra']);

        //Verifica se tem um ID, caso tenha, altera
        if (!is_null($id) && $id !== false) {
            $compra->setId($id);
            $this->entityManager->merge($compra);
            $_SESSION['mensagem'] = 'Compra atualizado com sucesso';
        } else {
            $this->entityManager->persist($compra);
            $_SESSION['mensagem'] = 'Compra inserido com sucesso';
        }
        $_SESSION['tipo_mensagem'] = 'success';

        $this->entityManager->flush();

        //Após preenchimento do form, redirecionar o usuário para listar-cursos
        header('Location: /listar-compras');
    }
}