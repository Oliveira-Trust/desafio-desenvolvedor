<?php

namespace Alura\Cursos\Controller\CompraController;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class FormularioInsercao extends ControllerComHtml implements InterfaceControladorRequisicao
{

    public function processaRequisicao(): void
    {
        $this->renderizaHTML('compra/formulario.php', [
            'titulo' => 'Nova Compra'
        ]);
    }
}