<?php


namespace Alura\Cursos\Controller;

class ControllerComHtml
{
    public function renderizaHTML(String $caminhoTemplate, array $dados) : void
    {
        extract($dados); //extrai as key dos controller e transforma as key em variaveis para usar em $dados
        require __DIR__ . '/../../View/' . $caminhoTemplate;
    }
}