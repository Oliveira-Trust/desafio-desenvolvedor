<?php


include_once ('../utils/db/Banco.php');

class ModelProduto
{

    private $banco;

    public function __construct()
    {
        $this->banco = new Banco();
    }

    public function listar(){
        $sql = "SELECT prk AS prkProduto, nomeProduto, precoProduto FROM produtos";


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

    public function deletar($prkProduto){


        $sql = "DELETE FROM produtos WHERE prk= $prkProduto";



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