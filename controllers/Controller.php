<?php


session_start();

//Controller pai onde se encontram os metodos genericos dos filhos.
class Controller{

    protected $model;
    protected $valida;

    //parametros recebidos pelo controller filho para utilizar o model e o validador correto da requisição.
    public function __construct($model, $valida)
    {
        $this->model = $model;
        $this->valida = $valida;

    }


    public function listar(){


        //Utiliza o metodo do model construido pelo filho do Controller.php.
        $statusRequisicao = $this->model->listar();


        //Caso aconteça algum problema no retorno da query é retornada uma mensagem de erro.
        if($statusRequisicao === false){
            json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao listar. Tente novamente mais tarde.']);
            return;
        }

        //Caso ocorra tudo certo é retonado sucesso e os dados.
        echo json_encode(['res'=>'1','dados' => $statusRequisicao]);
        return;

    }


    public function deletar(){

        //Utiliza o metodo da validação construida pelo filho do Controller.php.
        $statusValidacao = $this->valida->validaDeletar();



        //Caso alguma validação falhe é retornada uma mensagem de erro.
        if($statusValidacao['res'] == '0'){
            json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }



        //Utiliza o metodo do model construido pelo filho do Controller.php.
        $statusRequisicao = $this->model->deletar();

        //Caso aconteça algum problema no retorno da query é retornada uma mensagem de erro.
        if($statusRequisicao === false){
            json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao deletar. Tente novamente mais tarde.']);
            return;
        }


        //Caso ocorra tudo certo é retonado sucesso.
        echo json_encode(['res'=>'1']);
        return;

    }


    public function deletarVarios(){

        //Utiliza o metodo da validação construida pelo filho do Controller.php.
        $statusValidacao = $this->valida->validaDeletarVarios();


        //Caso alguma validação falhe é retornada uma mensagem de erro.
        if($statusValidacao['res'] == '0'){
            json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }


        //Utiliza o metodo do model construido pelo filho do Controller.php.
        $statusRequisicao = $this->model->DeletarVarios();

        //Caso aconteça algum problema no retorno da query é retornada uma mensagem de erro.
        if($statusRequisicao === false){
            echo json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao deletar varios. Tente novamente mais tarde.']);
            return;
        }



        //Caso ocorra tudo certo é retonado sucesso.
        echo json_encode(['res'=>'1']);
        return;

    }

    public function inserir(){

        //Utiliza o metodo da validação construida pelo filho do Controller.php.
        $statusValidacao =  $this->valida->validaInserir();


        //Caso alguma validação falhe é retornada uma mensagem de erro.
        if($statusValidacao['res'] == '0'){
            echo json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }


        //Utiliza o metodo do model construido pelo filho do Controller.php.
        $statusRequisicao = $this->model->inserir();

        //Caso aconteça algum problema no retorno da query é retornada uma mensagem de erro.
        if($statusRequisicao === false){
            echo json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao inserir. Tente novamente mais tarde.']);
            return;
        }


        //Caso ocorra tudo certo é retonado sucesso.
        echo json_encode(['res'=>'1']);
        return;

    }


    public function editar(){


        //Utiliza o metodo da validação construida pelo filho do Controller.php.
        $statusValidacao = $this->valida->validaEditar();

        //Caso alguma validação falhe é retornada uma mensagem de erro.
        if($statusValidacao['res'] == '0'){
            echo json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }


        //Utiliza o metodo do model construido pelo filho do Controller.php.
        $statusRequisicao = $this->model->editar();

        //Caso aconteça algum problema no retorno da query é retornada uma mensagem de erro.
        if($statusRequisicao === false){
            echo json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao editar. Tente novamente mais tarde.']);
            return;
        }


        //Caso ocorra tudo certo é retonado sucesso.
        echo json_encode(['res'=>'1']);
        return;

    }





}