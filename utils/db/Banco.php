<?php


class Banco
{
    private $usuario = "root";
    private $senha = "";
    private $banco = "oliveiratrust";
    private $host = "localhost";

    public function conexao(){

        try{
            $banco = new pdo('mysql:host='.$this->host.';dbname='.$this->banco , $this->usuario, $this->senha);
            return $banco;
        }
        catch (PDOException $e){
            return false;
        }

    }

}