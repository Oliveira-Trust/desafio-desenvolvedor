<?php


class ValidaProduto
{

    public function validaInserir(){


        if(!isset($_POST['nomeProduto']) || trim($_POST['nomeProduto']) === ''){
            return ['res' =>'0', 'msg'=>'O nome do produto não pode ser vazio.'];
        }

        if(is_numeric($_POST['nomeProduto'])){
            return ['res' =>'0', 'msg'=>'O nome do produto não pode conter números.'];
        }

        if(strlen($_POST['nomeProduto']) > 50){
            return ['res' =>'0', 'msg'=>'O nome do produto deve conter no máximo 50 caracteres.'];
        }

        return ['res' => '1'];

    }

    public function validaDeletar(){


        if(!isset($_POST['prkProduto'])){
            return ['res' =>'0', 'msg'=>'O id do produto não pode ser vazio.'];
        }

        if(!is_numeric($_POST['prkProduto'])){
            return ['res' =>'0', 'msg'=>'O id do produto deve ser numérico.'];
        }

        return ['res' => '1'];

    }

    public function validaEditar(){

        if(!isset($_POST['nomeProduto']) || trim($_POST['nomeProduto']) === ''){
            return ['res' =>'0', 'msg'=>'O nome do produto não pode ser vazio.'];
        }

        if(is_numeric($_POST['nomeProduto'])){
            return ['res' =>'0', 'msg'=>'O nome do produto não pode conter números.'];
        }

        if(strlen($_POST['nomeProduto']) > 50){
            return ['res' =>'0', 'msg'=>'O nome do produto deve conter no máximo 50 caracteres.'];
        }

        return ['res' => '1'];


    }


}