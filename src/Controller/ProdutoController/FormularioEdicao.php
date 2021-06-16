<?php

namespace Alura\Cursos\Controller\ProdutoController;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;
use Alura\Cursos\Entity\Produto;
use Alura\Cursos\Infra\EntityManagerCreator;

class FormularioEdicao extends ControllerComHtml implements InterfaceControladorRequisicao
{

    private $entityManager;
    private $repositorioProdutos;

    public function __construct()
    {
        $entityManager= (new EntityManagerCreator())
            ->getEntityManager();
        $this->repositorioProdutos = $entityManager
            ->getRepository(Produto::class);
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

        //Caso o produto não tenha um id válido, retorna para listar produtos
        if(is_null($id) || $id === false){
            header('Location: /listar-produtos');
            return;
        }
        $produto = $this->repositorioProdutos->find($id);
        $this->renderizaHtml ('produto/formulario.php', [
            'produto' => $produto,
            'titulo' => "Alterar Produto " . $produto->getNome()
        ]);
    }
}