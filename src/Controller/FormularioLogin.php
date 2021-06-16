<?php


namespace Alura\Cursos\Controller;


class FormularioLogin extends  ControllerComHtml implements InterfaceControladorRequisicao
{
    public function processaRequisicao () :void
    {
        $this->renderizaHTML('login/formulario.php', [
            'titulo' => 'Login'
        ]);
    }
}