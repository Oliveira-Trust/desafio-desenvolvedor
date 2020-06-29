<?php


include_once ('../utils/db/Banco.php');

class ModelLogin
{
    private $banco;

    public function __construct()
    {
        $this->banco = new Banco();
    }


    public function login(){


        $nomeCliente = $_POST['nomeCliente'];
        $senhaCliente = $_POST['senhaCliente'];

        $sql = "SELECT nomeCliente, senhaCliente FROM clientes WHERE nomeCliente ='$nomeCliente'AND senhaCliente = $senhaCliente";



        if ($this->banco !== false) {
            try {
                $prepara = $this->banco->conexao()->prepare($sql);
                $prepara->execute();
                $dados = $prepara->fetch(PDO::FETCH_ASSOC);
                return $dados;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }




    }

}