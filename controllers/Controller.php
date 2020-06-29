<?php


session_start();

class Controller{

    private $model;
    private $valida;

    public function __construct($model, $valida)
    {
        $this->model = $model;
        $this->valida = $valida;

    }


    public function listar(){


        $dados = $this->model->listar();


        if($dados === false){
            json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao listar. Tente novamente mais tarde.']);
            return;
        }

        echo json_encode(['res'=>'1','dados' => $dados]);
        return;

    }


    public function deletar(){

        $statusValidacao = $this->valida->validaDeletar();



        if($statusValidacao['res'] == '0'){
            json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }



        $statusRequisicao = $this->model->deletar();

        if($statusRequisicao === false){
            json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao deletar. Tente novamente mais tarde.']);
            return;
        }


        echo json_encode(['res'=>'1']);
        return;

    }

    public function inserir(){
        $statusValidacao =  $this->valida->validaInserir();


        if($statusValidacao['res'] == '0'){
            echo json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }


        $statusRequisicao = $this->model->inserir();

        if($statusRequisicao === false){
            echo json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao inserir. Tente novamente mais tarde.']);
            return;
        }



        echo json_encode(['res'=>'1']);
        return;

    }


    public function editar(){


        $statusValidacao = $this->valida->validaEditar();

        if($statusValidacao['res'] == '0'){
            echo json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }



        $statusRequisicao = $this->model->editar();

        if($statusRequisicao === false){
            echo json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao editar. Tente novamente mais tarde.']);
            return;
        }

        echo json_encode(['res'=>'1']);
        return;

    }

    public function login(){

        $_SESSION['acessoPermitido'] = false;

        $statusValidacao =  $this->valida->login();


        if($statusValidacao['res'] == '0'){
            echo json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }


        $statusRequisicao = $this->model->login();



        if($statusRequisicao === false || empty($statusRequisicao)){
            echo json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao fazer login. Tente novamente']);
            return;
        }

        $_SESSION['acessoPermitido'] = true;


        echo json_encode(['res'=>'1']);
    }

    public function deslogar(){

        unset($_SESSION['acessoPermitido']);

        echo json_encode(['res'=>'1']);
    }


     public function getDadosModalInserir(){


         $statusRequisicao = $this->model->getDadosModalInserir();


         if($statusRequisicao === false || empty($statusRequisicao)){
             echo json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao buscar as informações do modal. Tente novamente mais tarde.']);
             return;
         }

         echo json_encode(['res'=>'1','dados' => $statusRequisicao]);
         return;

     }

     public function cadastrar(){

         $statusValidacao =  $this->valida->cadastrar();


         if($statusValidacao['res'] == '0'){
             echo json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
             return;
         }


         $statusRequisicao = $this->model->cadastrar();



         if($statusRequisicao === false || empty($statusRequisicao)){
             echo json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao fazer o cadastro. Tente novamente']);
             return;
         }

         echo json_encode(['res'=>'1']);
         return;

     }




}