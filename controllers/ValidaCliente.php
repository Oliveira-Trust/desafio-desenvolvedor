<?php


class ValidaCliente
{

    public function validaInserirCliente(){

    }

    public function validaDeletarCliente(){

        if(!isset($_POST['prkCliente'])){
            return ['res' =>'0', 'msg'=>'O id do cliente não pode ser vazio.'];
        }

        if(!is_numeric($_POST['prkCliente'])){
            return ['res' =>'0', 'msg'=>'O id do cliente deve ser numérico.'];
        }

        return ['res' => '1'];

    }

    public function validaEditarCliente(){

    }

}