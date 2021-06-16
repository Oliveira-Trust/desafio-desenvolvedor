<?php


namespace Alura\Cursos\Controller;


class PrincipalController extends ControllerComHtml implements InterfaceControladorRequisicao

{
    public function processaRequisicao () :void
    {
        $this->renderizaHTML('/principal.php', [
            'titulo' => 'Tela Inicial'
        ]);
    }
}
