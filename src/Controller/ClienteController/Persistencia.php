<?php

namespace Alura\Cursos\Controller\ClienteController;

use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Cliente;
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

        $cpf = filter_input(
            INPUT_POST,
            'cpf',
            FILTER_SANITIZE_STRING
        );

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        $cliente = new Cliente();
        $cliente->setNome($_POST['nome']);
        $cliente->setCpf($_POST['cpf']);


        if (!is_null($id) && $id !== false) {
            $cliente->setId($id);
            $cliente->setCpf($cpf);
            $this->entityManager->merge($cliente);
            $_SESSION['mensagem'] = 'Cliente atualizado com sucesso';
        } else {
            $this->entityManager->persist($cliente);
            $_SESSION['mensagem'] = 'Cliente inserido com sucesso';
        }
        $_SESSION['tipo_mensagem'] = 'success';

        $this->entityManager->flush();

        //Após preenchimento do form, redirecionar o usuário para listar-cursos
        header('Location: /listar-clientes');
    }
}