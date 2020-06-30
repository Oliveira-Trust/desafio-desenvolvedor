<?php



include_once ('../utils/db/Banco.php');

class ModelPedido
{

    private $banco;

    public function __construct()
    {
        $this->banco = new Banco();
    }


    public function listar()
    {
        $sql =  "SELECT p.prk AS prkPedido,nomeCliente,nomeProduto,status
                 FROM pedidos AS p
                 JOIN clientes AS c ON c.prk = P.frkCliente
                 JOIN produtos AS pr ON pr.prk = P.frkProduto";



        if ($this->banco !== false) {
            try {
                $prepara = $this->banco->conexao()->prepare($sql);
                $prepara->execute();
                $dados = $prepara->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }

        return $dados;

    }


    public function inserir(){

        $frkProduto = $_POST['frkProduto'];
        $frkCliente = $_POST['frkCliente'];
        $status = $_POST['status'];


        $sql = "INSERT INTO pedidos (frkCliente, frkProduto, status) VALUES ('$frkCliente','$frkProduto','$status')";


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

    public function deletar(){

        $prkPedido = $_POST['prkPedido'];

        $sql = "DELETE FROM pedidos WHERE prk='$prkPedido'";


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

    public function deletarVarios(){


        $prkPedido = explode(",",$_POST['prkPedido']);


        if($this->banco !== false){
            try{
                foreach($prkPedido as $i => $val){
                    $sql = "DELETE FROM pedidos WHERE prk= $prkPedido[$i]";
                    $prepara = $this->banco->conexao()->prepare($sql);
                    $prepara->execute();
                }
                return true;
            }catch (PDOException $e){
                return false;
            }
        }else{
            return false;
        }


    }

    public function editar(){

        $frkProduto = $_POST['frkProduto'];
        $frkCliente = $_POST['frkCliente'];
        $status = $_POST['status'];
        $prkPedido = $_POST['prkPedido'];


        $sql = "UPDATE pedidos SET frkProduto= $frkProduto, frkCliente = $frkCliente, status = '$status'  WHERE prk = $prkPedido";


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



    public function getDadosModalInserir(){


        $array = [
            'nomeProduto'=>'SELECT nomeProduto,prk AS prkProduto FROM produtos',
            'nomeCliente'=>'SELECT nomeCliente,prk AS prkCliente FROM clientes',
        ];


        if ($this->banco !== false) {
            try {
                foreach($array as $i => $val){
                    $prepara = $this->banco->conexao()->prepare($array[$i]);
                    $prepara->execute();
                    $dados[] = $prepara->fetchAll(PDO::FETCH_ASSOC);
                }
            } catch (PDOException $e) {
                return false;
            }
        } else {
            return false;
        }


        return $dados;

    }





}