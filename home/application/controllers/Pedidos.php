<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidos extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        
        // Model para carregar pedidos
        $this->load->model('pedidos_model','pedidos');
        
        // Model para carregar clientes
        $this->load->model('clientes_model','clientes');
        
        // Model para carregar produtos
        $this->load->model('produtos_model','produtos');
    }

    public function index($ordem = 'dataPedido')
    {
        // Busca dados dos pedidos
        $dados["pedidos"] = $this->pedidos->getPedidos($ordem);
        
        $dados["titulo"] = "SYSOT - Pedidos";
        $this->load->view('includes/header',$dados);
        $this->load->view('includes/menu');
        $this->load->view('pages/pedidos/listapedido');
        $this->load->view('includes/footer');
    }
    
    public function novo()
    {
        
        // Busca nome dos clientes
        $dados["clientes"] = $this->clientes->getNomesClientes();
        
        // Busca produtos
        $dados["produtos"] = $this->produtos->getDescricaoProdutos();
                
        $dados["titulo"] = "SYSOT - Pedido Novo";
        $this->load->view('includes/header',$dados);
        $this->load->view('includes/menu');
        $this->load->view('pages/pedidos/novopedido');
        $this->load->view('includes/footer');
    }
    
    public function salva()
    {
        // Chama biblioteca de validação
        $this->load->library('form_validation');
        
        // Valida campos do formulário
        $this->form_validation->set_rules('slcCliente','Cliente','required');
        $this->form_validation->set_rules('slcProduto','Senha','required');
        $this->form_validation->set_rules('numValor','Valor','trim|required|decimal');
        $this->form_validation->set_rules('slcStatus','Status','required');

        // Se erro na validação, exiba o erro
        if ( $this->form_validation->run() == FALSE )
        {
            $dados["formerror"] = validation_errors();
            
            $intIDPedido = $this->input->post('hidIdPedido');
            
            redirect("/pedidos/editapedido/$intIDPedido");

        }else{
            
            $dados["formerror"] = NULL;
            
            //Guarda os campos
            $dadosForm["idClientes"] = $this->input->post("slcCliente");
            $dadosForm["idProdutos"] = $this->input->post("slcProduto");
            $dadosForm["valor"] = $this->input->post("numValor");
            $dadosForm["status"] = $this->input->post("slcStatus"); // Status 1 -ABERTO, 2 -PAGO, 3 -CANCELADO

            //Se foi passado ele vai fazer atualização no registro.	
            if ($this->pedidos->editaPedido($dadosForm, $this->input->post('hidIdPedido'))):
                echo "<script>alert('asasas')</script>";
                redirect("/pedidos/");
            else:
                redirect("/pedidos/novo");
            endif;

        }
    }
    
    
    public function salvaNovo()
    {
        // Chama biblioteca de validação
        $this->load->library('form_validation');
        
        // Valida campos do formulário
        $this->form_validation->set_rules('slcCliente','Cliente','required');
        $this->form_validation->set_rules('slcProduto','Senha','required');
        $this->form_validation->set_rules('numValor','Valor','trim|required');

        // Se erro na validação, exiba o erro
        if ( $this->form_validation->run() == FALSE )
        {
            $dados["formerror"] = validation_errors();
            
            $dados["titulo"] = "SYSOT - Novo Pedido";
            $this->load->view('includes/header',$dados);
            $this->load->view('includes/menu');
            $this->load->view('pages/pedidos/novopedido');
            $this->load->view('includes/footer');
            
        }else{
            
            $dados["formerror"] = NULL;
           
            //Guarda os campos
            $dadosForm["idClientes"] = $this->input->post("slcCliente");
            $dadosForm["idProdutos"] = $this->input->post("slcProduto");
            $dadosForm["valor"] = $this->input->post("numValor");
            $dadosForm["dataPedido"] = date("Y-m-d H:i:s");
            $dadosForm["status"] = 1; // Pedido ABERTO
                
            // Enviar os dados para função adiciona pedido
            $this->pedidos->addPedido($dadosForm);

            redirect("/pedidos/");

        }
    }
    
    public function editapedido($id = NULL)
    {
        
        // Busca nome dos clientes
        $dados["clientes"] = $this->clientes->getNomesClientes();
        
        // Busca produtos
        $dados["produtos"] = $this->produtos->getDescricaoProdutos();
        
	//Verifica se foi passado um ID, se não vai para a página listar pedidos
	if($id == NULL) {
		redirect('/pedidos/');
	}

	//Faz a consulta no banco de dados pra verificar se existe
	$query = $this->pedidos->getPedidoByID($id);

	//Verifica que a consulta voltar um registro, se não vai para a página listar pedidos
	if($query == NULL) {
		redirect('/pedidos/');
	}
	
	//Guarda dados dos pedidos
	$dados['pedidos'] = $query;

	//Carrega a View
        $dados["titulo"] = "SYSOT - Cliente Novo";
        $this->load->view('includes/header',$dados);
        $this->load->view('includes/menu');
        $this->load->view('pages/pedidos/editapedido');
        $this->load->view('includes/footer');

    }
        
    //Função Apagar Pedido
    public function excluipedido($id=NULL)
    {
            //Verifica se foi passado um ID, se não vai para a página listar pedidos
            if($id == NULL) {
                redirect('/pedidos/');
            }

            //Consulta no banco de dados pra verificar se existe
            $query = $this->pedidos->getPedidoByID($id);

            //Verifica se foi encontrado um registro com a ID passada
            if($query != NULL) {

                //Executa a função Pedidos_model
                $this->pedidos->apagaPedido($query->id);

                redirect('/pedidos/novo');

            } else {
                //Se não encontrou nenhum registro no banco de dados com a ID passada ele volta para página listar pedidos
                redirect('/pedidos/');
            }


    }
    
    
//Função Apagar Pedido
    public function excluipedidoLOTE()
    {

        // Recebe ids dos clientes que serão apagados
        $listaID = $this->input->post('chkDeleta');

        //Verifica se foi passado um ID, se não vai para a página listar clientes
        if($listaID == NULL) :

            redirect('/pedidos/');

        else:

            $_SESSION["mensagem"] = "";

            foreach ($listaID as $id){

                // Busca dados dos pedidos do cliente
                $query = $this->pedidos->getPedidosById($id);

                //Verifica se foi encontrado um registro com a ID e status Aberto, apagar pedido
                if($query != NULL && $query[0]->status == 1) {

                    //Executa a função Clientes_model
                    $this->pedidos->apagaPedido($id);

                } else {

                    // Mensagem para o redirect
                    $_SESSION["mensagem"] =  $_SESSION["mensagem"] . "<br>Pedido ID ".$query[0]->id." está como PAGO ou CANCELADO.";

                }

            };

            redirect('/pedidos/');

        endif;

    }

}
