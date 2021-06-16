<?php

namespace Alura\Cursos\Controller\ProdutoController;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class FormularioInsercao extends ControllerComHtml implements InterfaceControladorRequisicao
{

    public function processaRequisicao(): void
    {
        $this->renderizaHTML('produto/formulario.php', [
            'titulo' => 'Novo Produto'
        ]);
    }
}