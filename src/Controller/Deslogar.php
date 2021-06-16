<?php


namespace Alura\Cursos\Controller;

class Deslogar implements InterfaceControladorRequisicao
{

    public function processaRequisicao(): void
    {
        session_destroy();
        header('Location: /login');
    }
}