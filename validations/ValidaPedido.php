<?php


class ValidaPedido
{

    public function validaInserir(){



        if(!isset($_POST['frkProduto']) || trim($_POST['frkProduto']) === '' || $_POST['frkProduto'] == 'undefined'){
            return ['res' =>'0', 'msg'=>'O nome do produto não pode ser vazio.'];
        }

        if(!isset($_POST['frkCliente']) || trim($_POST['frkCliente']) === '' || $_POST['frkCliente'] == 'undefined'){
            return ['res' =>'0', 'msg'=>'O nome do cliente não pode ser vazio.'];
        }

        if(!isset($_POST['status']) || trim($_POST['status']) === '' || $_POST['status'] == 'undefined'){
            return ['res' =>'0', 'msg'=>'O nome do pedido não pode ser vazio.'];
        }

        if(strlen($_POST['frkProduto']) > 50){
            return ['res' =>'0', 'msg'=>'O nome do produto deve conter no máximo 50 caracteres.'];
        }

        if(strlen($_POST['frkCliente']) > 50){
            return ['res' =>'0', 'msg'=>'O nome do produto deve conter no máximo 50 caracteres.'];
        }

        if(is_numeric($_POST['status'])){
            return ['res' =>'0', 'msg'=>'O status não pode ser numérico.'];
        }




        return ['res' => '1'];

    }

    public function validaDeletar(){


        if(!isset($_POST['prkPedido'])){
            return ['res' =>'0', 'msg'=>'O id do cliente não pode ser vazio.'];
        }

        if(!is_numeric($_POST['prkPedido'])){
            return ['res' =>'0', 'msg'=>'O id do cliente deve ser numérico.'];
        }




        return ['res' => '1'];
    }

    public function validaEditar(){

        if(!isset($_POST['frkProduto']) || trim($_POST['frkProduto']) === ''  || $_POST['frkProduto'] == 'undefined'){
            return ['res' =>'0', 'msg'=>'O nome do produto não pode ser vazio.'];
        }

        if(!isset($_POST['frkCliente']) || trim($_POST['frkCliente']) === '' || $_POST['frkCliente'] == 'undefined'){
            return ['res' =>'0', 'msg'=>'O nome do cliente não pode ser vazio.'];
        }

        if(!isset($_POST['status']) || trim($_POST['status']) === ''  || $_POST['status'] == 'undefined'){
            return ['res' =>'0', 'msg'=>'O nome do pedido não pode ser vazio.'];
        }

        if(strlen($_POST['frkProduto']) > 50){
            return ['res' =>'0', 'msg'=>'O nome do produto deve conter no máximo 50 caracteres.'];
        }

        if(strlen($_POST['frkCliente']) > 50){
            return ['res' =>'0', 'msg'=>'O nome do produto deve conter no máximo 50 caracteres.'];
        }

        if(is_numeric($_POST['status'])){
            return ['res' =>'0', 'msg'=>'O status não pode ser numérico.'];
        }


        return ['res' => '1'];

    }

    public function validaDeletarVarios(){

        $prkPedido = explode(",",$_POST['prkPedido']);


        if(!isset($_POST['prkPedido']) || trim($_POST['prkPedido']) === ''){
            return ['res' =>'0', 'msg'=>'O id do pedido não pode ser vazio.'];
        }

        foreach ($prkPedido as $val){
            if(!is_numeric($val)){
                return ['res' =>'0', 'msg'=>'O id do produto deve ser numérico.'];
            }
        }



        return ['res' => '1'];

    }



}