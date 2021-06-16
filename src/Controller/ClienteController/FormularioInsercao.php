<?php

namespace Alura\Cursos\Controller\ClienteController;

use Alura\Cursos\Controller\ControllerComHtml;
use Alura\Cursos\Controller\InterfaceControladorRequisicao;

class FormularioInsercao extends ControllerComHtml implements InterfaceControladorRequisicao
{

    public function processaRequisicao(): void
    {
        $this->renderizaHTML('cliente/formulario.php', [
            'titulo' => 'Novo Cliente'
        ]);
    }
}