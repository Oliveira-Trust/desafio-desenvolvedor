<?php


include_once ('../utils/db/Banco.php');

class ModelCliente
{

    private $banco;

    public function __construct()
    {
        $this->banco = new Banco();
    }

    public function listar(){
        $sql = "SELECT prk AS prkCliente, nomeCliente As nomeCliente FROM clientes";


        if($this->banco !== false) {
            try {
                $prepara = $this->banco->conexao()->prepare($sql);
                $prepara->execute();
                $dados = $prepara->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return false;
            }
        }else{
            return false;
        }

        return $dados;

    }

    public function deletar($prkCliente){
        $sql = "DELETE FROM clientes WHERE prk='$prkCliente'";


        if($this->banco !== false){
            try{
                $prepara = $this->banco->conexao()->prepare($sql);
                $prepara->execute();
                return true;
            }catch (PDOException $e){
                return false;
            }
        }else{
            return false;
        }


    }


    public function inserir($nomeCliente){

        $sql = "INSERT INTO clientes (nomeCliente) VALUES ('$nomeCliente')";


        if($this->banco !== false){
            try{
                $prepara = $this->banco->conexao()->prepare($sql);
                $prepara->execute();
                return true;
            }catch (PDOException $e){
                return false;
            }
        }else{
            return false;
        }



    }


    public function editar($prkCliente, $nomeCliente){

        $sql = "UPDATE clientes SET nomeCliente = '$nomeCliente' WHERE prk = $prkCliente";


        if($this->banco !== false){
            try{
                $prepara = $this->banco->conexao()->prepare($sql);
                $prepara->execute();
                return true;
            }catch (PDOException $e){
                return false;
            }
        }else{
            return false;
        }



    }

}