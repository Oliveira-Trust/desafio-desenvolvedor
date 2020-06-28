<?php



class Controller{

    private $model;
    private $valida;

    public function __construct($model, $valida)
    {
        $this->model = $model;
        $this->valida = $valida;

    }


    public function listar(){


        $dados = $this->model->listarCliente();


        if($dados === false){
            json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao listar']);
            return;
        }

        echo json_encode(['res'=>'1','dados' => $dados]);
        return;

    }

    public function inserir(){
        $this->valida->validaInserirCliente();


        json_encode(['res'=>'1','']);

    }

    public function deletar(){
        $this->valida->validaDeletarCliente();

        json_encode(['res'=>'1']);

    }

    public function editar(){
        $this->valida->validaEditarCliente();

        json_encode(['res'=>'1']);

    }


}