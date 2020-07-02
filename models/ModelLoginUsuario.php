<?php


include_once ('../utils/db/Banco.php');

class ModelLoginUsuario
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
        $sqlChecaEmailExistente = "SELECT email FROM usuarios  WHERE email = '$email'";




        if ($this->banco !== false) {
            try {

                $prepara = $this->banco->conexao()->prepare($sqlChecaEmailExistente);
                $prepara->execute();
                $dados = $prepara->fetch(PDO::FETCH_ASSOC);


                if(isset($dados) && $dados != false){
                    return 'emailExistente';
                }

                $prepara = $this->banco->conexao()->prepare($sql);
                $status = $prepara->execute();


                return $status;
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }


    }

}