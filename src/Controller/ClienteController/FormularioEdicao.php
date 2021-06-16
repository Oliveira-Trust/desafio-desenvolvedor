<?php

namespace Alura\Cursos\Controller\ClienteController;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Cliente;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao extends ControllerComHtml implements InterfaceControladorRequisicao
{

    private $entityManager;
    private $repositorioClientes;

    public function __construct()
    {
        $entityManager= (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioClientes = $entityManager
            ->getRepository(Cliente::class);
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

        //Caso o cliente não tenha um id válido, retorna para listar clientes
        if(is_null($id) || $id === false){
            $_SESSION['tipo_mensagem'] = 'danger';
            $_SESSION['mensagem'] = 'Cliente inexistente';

            header('Location: /listar-clientes');
            return;
        }

        $cliente = $this->repositorioClientes->find($id);
        $this->renderizaHtml ('cliente/formulario.php', [
            'cliente' => $cliente,
            'titulo' => "Alterar cliente " . $cliente->getNome()
        ]);
    }
}