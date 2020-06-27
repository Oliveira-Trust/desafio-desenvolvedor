<?php


class Banco
{
    private $usuario = "";
    private $senha = "";
    private $banco = "";

    public function banco(){

        $banco = new pdo();
        return $banco;

    }

}