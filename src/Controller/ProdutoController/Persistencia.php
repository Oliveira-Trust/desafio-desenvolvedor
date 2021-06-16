<?php

namespace Alura\Cursos\Controller\ProdutoController;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Produto;
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

        $descricao = filter_input(
            INPUT_POST,
            'descricao',
            FILTER_SANITIZE_STRING
        );

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        $produto = new Produto();
        $produto->setNome($_POST['nome']);
        $produto->setDescricao($_POST['descricao']);


        if (!is_null($id) && $id !== false) {
            $produto->setId($id);
            $produto->setDescricao($descricao);
            $this->entityManager->merge($produto);
            $_SESSION['mensagem'] = 'Produto atualizado com sucesso';
        } else {
            $this->entityManager->persist($produto);
            $_SESSION['mensagem'] = 'Produto inserido com sucesso';
        }
        $_SESSION['tipo_mensagem'] = 'success';

        $this->entityManager->flush();

        //Após preenchimento do form, redirecionar o usuário para listar-cursos
        header('Location: /listar-produtos');
    }
}