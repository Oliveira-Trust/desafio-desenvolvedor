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


        $email = $_POST['email'];
        $senha = sha1($_POST['senha']);

        $sql = "SELECT email, senha FROM usuarios WHERE email ='$email'AND senha = '$senha'";


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

    public function cadastrar(){

        $email = $_POST['email'];
        $senha = sha1($_POST['senha']);

        $sql = "INSERT INTO usuarios (email,senha) VALUES ('$email','$senha')";




        if ($this->banco !== false) {
            try {
                $prepara = $this->banco->conexao()->prepare($sql);
                $prepara->execute();


                return true;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }


    }

}