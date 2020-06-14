<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        
        // Model para carregar clientes
        $this->load->model('produtos_model','produtos');
    }

    public function index($ordem = 'descricao')
    {
        // Busca dados dos produtos
        $dados["produtos"] = $this->produtos->getProdutos($ordem);

        $dados["titulo"] = "SYSOT - Produtos";
        $this->load->view('includes/header',$dados);
        $this->load->view('includes/menu');
        $this->load->view('pages/produtos/listaprodutos');
        $this->load->view('includes/footer');
    }
    
    public function novo()
    {
        $dados["titulo"] = "SYSOT - Produto Novo";
        $this->load->view('includes/header',$dados);
        $this->load->view('includes/menu');
        $this->load->view('pages/produtos/novoproduto');
        $this->load->view('includes/footer');
    }
    
    public function salva()
    {
        // Chama biblioteca de validação
        $this->load->library('form_validation');
        
        // Valida campos do formulário
        $this->form_validation->set_rules('txtDescricao','Descrição','trim|required');
        $this->form_validation->set_rules('numPreco','Preço','trim|required');
        
        // Se erro na validação, exiba o erro
        if ( $this->form_validation->run() == FALSE )
        {
            $dados["formerror"] = validation_errors();
            
            $dados["titulo"] = "SYSOT - Produto Novo";
            $this->load->view('includes/header',$dados);
            $this->load->view('includes/menu');
            $this->load->view('pages/produtos/novoproduto');
            $this->load->view('includes/footer');
            
        }else
        {
            $dados["formerror"] = NULL;
           
            
            //Verifica se foi passado via post a id do cliente
            if ($this->input->post('id') != NULL) {
                
                //Guarda os campos
                $dadosForm["descricao"] = $this->input->post("txtDescricao");
                $dadosForm["preco"] = $this->input->post("numPreco");
                
                //Se foi passado ele vai fazer atualização no registro.	
                $this->produtos->editaProduto($dadosForm, $this->input->post('id'));
                
            } else {
                
                //Guarda os campos
                $dadosForm["descricao"] = $this->input->post("txtDescricao");
                $dadosForm["preco"] = $this->input->post("numPreco");

                
                // Enviar os dados para função cadastracliente
                $this->produtos->addProduto($dadosForm);
            }
            

            redirect("/produtos/");

        }


    }
    
    public function editaproduto($id = NULL)
    {
	//Verifica se foi passado um ID, se não vai para a página listar produtos
	if($id == NULL) {
		redirect('/produtos/');
	}

	//Faz a consulta no banco de dados pra verificar se existe
	$query = $this->produtos->getProdutoByID($id);

	//Verifica que a consulta voltar um registro, se não vai para a página listar produtos
	if($query == NULL) {
		redirect('/produtos/');
	}
	
	//Guarda dados dos clientes
	$dados['produtos'] = $query;

	//Carrega a View
        $dados["titulo"] = "SYSOT - Produto Novo";
        $this->load->view('includes/header',$dados);
        $this->load->view('includes/menu');
        $this->load->view('pages/produtos/editaproduto');
        $this->load->view('includes/footer');

        }
        
    //Função Apagar Produto
    public function excluiproduto($id=NULL)
    {
            //Verifica se foi passado um ID, se não vai para a página listar produtos
            if($id == NULL) {
                redirect('/produtos/');
            }

            //Consulta no banco de dados pra verificar se existe
            $query = $this->produtos->getProdutoByID($id);

            //Verifica se foi encontrado um registro com a ID passada
            if($query != NULL) {

                //Executa a função Clientes_model
                $this->produtos->apagaProduto($query->id);

                redirect('/produtos/');

            } else {
                //Se não encontrou nenhum registro no banco de dados com a ID passada ele volta para página listar produtos
                redirect('/produtos/');
            }


    }
        
    //Função Apagar clientes em LOTE
    public function exluiprodutoLOTE()
    {

        // Model para carregar pedidos
        $this->load->model('pedidos_model','pedidos');

        // Recebe ids dos produtos que serão apagados
        $listaID = $this->input->post('chkDeleta');

        //Verifica se foi passado um ID, se não vai para a página listar produtos
        if($listaID == NULL) :

            redirect('/produtos/');

        else:

            $_SESSION["mensagem"] = "";

            foreach ($listaID as $id){

                // Busca dados dos pedidos com o produto
                $query = $this->pedidos->getPedidosByIdProduto($id);

                //Verifica se foi encontrado um registro com a ID passada
                if($query == NULL) {

                    //Executa a função Clientes_model
                    $this->produtos->apagaProduto($id);

                } else {

                    // Mensagem para o redirect
                    $_SESSION["mensagem"] =  $_SESSION["mensagem"] . "<br>Produto ID $id está em um pedido.";

                }

            };

            redirect('/produtos/');

        endif;

    }

}