<?php


include_once ('../utils/db/Banco.php');

class ModelCliente
{

    private $banco;

    public function __construct()
    {
        $this->banco = new Banco();
    }

    public function listarCliente(){

    }

    public function inserirCliente($prkCliente, $nomeCliente){

    }

    public function deletarCliente($prkCliente){

    }

    public function editarCliente($prkCliente, $nomeCliente){

    }

}