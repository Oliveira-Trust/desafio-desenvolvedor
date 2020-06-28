<?php


class Banco
{
    private $usuario = "root";
    private $senha = "";
    private $banco = "OliveiraTrust";
    private $host = "localhost";

    public function conexao(){

        $banco = new pdo('mysql:host='.$this->host.';dbname='.$this->banco , $this->usuario, $this->senha);
        return $banco;

    }

}