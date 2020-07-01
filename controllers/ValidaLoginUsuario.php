<?php


class ValidaLoginUsuario
{

    public function login(){

        if(!isset($_POST['email']) || trim($_POST['email']) === ''){
            return ['res' =>'0', 'msg'=>'O email não pode ser vazio.'];
        }

        if(!isset($_POST['senha']) || trim($_POST['senha']) === ''){
            return ['res' =>'0', 'msg'=>'A senha não pode ser vazia.'];
        }

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            return ['res' =>'0', 'msg'=>'Digite um email valido.'];
        }

        if(strlen($_POST['email']) > 50){
            return ['res' =>'0', 'msg'=>'O email deve conter no máximo 50 caracteres.'];
        }


    }

    public function cadastrar(){

        if(!isset($_POST['email']) || trim($_POST['email']) === ''){
            return ['res' =>'0', 'msg'=>'O email não pode ser vazio.'];
        }

        if(!isset($_POST['senha']) || trim($_POST['senha']) === ''){
            return ['res' =>'0', 'msg'=>'A senha não pode ser vazia.'];
        }

        if(strlen($_POST['senha']) < 5){
            return ['res' =>'0', 'msg'=>'A senha deve possuir no minimo 5 caracteres.'];
        }

        if(strlen($_POST['senha']) > 20){
            return ['res' =>'0', 'msg'=>'A senha deve conter no máximo 20 caracteres.'];
        }

        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            return ['res' =>'0', 'msg'=>'Digite um email valido.'];
        }


    }
}