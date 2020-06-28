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
            json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao listar. Tente novamente mais tarde.']);
            return;
        }

        echo json_encode(['res'=>'1','dados' => $dados]);
        return;

    }


    public function deletar(){
        $statusValidacao = $this->valida->validaDeletarCliente();


        if($statusValidacao['res'] == '0'){
            json_encode(['res'=>'0','msg'=> $statusValidacao['msg']]);
            return;
        }


        $statusRequisicao = $this->model->deletarCliente($_POST['prkCliente']);

        if($statusRequisicao === false){
            json_encode(['res'=>'0','msg'=>'Ocorreu um erro ao deletar. Tente novamente mais tarde.']);
            return;
        }


        echo json_encode(['res'=>'1']);
        return;

    }

    public function inserir(){
        $this->valida->validaInserirCliente();


        echo json_encode(['res'=>'1','dados' ]);
        return;

    }



    public function editar(){
        $this->valida->validaEditarCliente();

        echo json_encode(['res'=>'1','dados' ]);
        return;

    }


}