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
        $sql = 'SELECT prk AS prkUsuario, nomeCliente As nomeCliente FROM clientes';


        $prepara = $this->banco->conexao()->prepare($sql);
        $prepara->execute();
        $dados = $prepara->fetchAll(PDO::FETCH_ASSOC);

//
//        var_dump($dados);exit();
        return $dados;


    }

    public function inserirCliente($prkCliente, $nomeCliente){

    }

    public function deletarCliente($prkCliente){

    }

    public function editarCliente($prkCliente, $nomeCliente){

    }

}