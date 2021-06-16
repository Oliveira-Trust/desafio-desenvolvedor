<?php

namespace Alura\Cursos\Controller\CompraController;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Compra;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao extends ControllerComHtml implements InterfaceControladorRequisicao
{

    private $entityManager;
    private $repositorioCompras;

    public function __construct()
    {
        $entityManager= (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioCompras = $entityManager
            ->getRepository(Compra::class);
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

        //Caso a compra não tenha um id válido, retorna para listar clientes
        if(is_null($id) || $id === false){
            header('Location: /listar-compras');
            return;
        }
        $compra = $this->repositorioCompras->find($id);
        $this->renderizaHtml ('compra/formulario.php', [
            'compra' => $compra,
            'titulo' => "Alterar Produto " . $compra->getNome()
        ]);
    }
}