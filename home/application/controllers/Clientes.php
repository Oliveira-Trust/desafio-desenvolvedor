<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        
        // Model para carregar clientes
        $this->load->model('clientes_model','clientes');
    }

    public function index($ordem = 'nome')
    {
        // Busca dados dos clientes
        $dados["clientes"] = $this->clientes->getClientes($ordem);

        $dados["titulo"] = "SYSOT - Clientes";
        $this->load->view('includes/header',$dados);
        $this->load->view('includes/menu');
        $this->load->view('pages/clientes/listacliente');
        $this->load->view('includes/footer');
    }
    
    public function novo()
    {
        $dados["titulo"] = "SYSOT - Cliente Novo";
        $this->load->view('includes/header',$dados);
        $this->load->view('includes/menu');
        $this->load->view('pages/clientes/novocliente');
        $this->load->view('includes/footer');
    }
    
    public function salva()
    {
        // Chama biblioteca de validação
        $this->load->library('form_validation');
        
        // Valida campos do formulário
        $this->form_validation->set_rules('txtNome','Nome','trim|required');
        $this->form_validation->set_rules('pasSenha','Senha','trim|required');
        $this->form_validation->set_rules('txtEmail','Email','trim|valid_email|required');
        
        // Se erro na validação, exiba o erro
        if ( $this->form_validation->run() == FALSE )
        {
            $dados["formerror"] = validation_errors();
            
            $dados["titulo"] = "SYSOT - Cliente Novo";
            $this->load->view('includes/header',$dados);
            $this->load->view('includes/menu');
            $this->load->view('pages/clientes/novocliente');
            $this->load->view('includes/footer');
            
        }else
        {
            $dados["formerror"] = NULL;
           
            
            //Verifica se foi passado via post a id do cliente
            if ($this->input->post('id') != NULL) {
                
                //Guarda os campos
                $dadosForm["nome"] = $this->input->post("txtNome");
                $dadosForm["senha"] = $this->input->post("pasSenha");
                $dadosForm["email"] = $this->input->post("txtEmail");
                
                //Se foi passado ele vai fazer atualização no registro.	
                $this->clientes->editaCliente($dadosForm, $this->input->post('id'));
                
            } else {
                
                //Guarda os campos
                $dadosForm["nome"] = $this->input->post("txtNome");
                $dadosForm["senha"] = $this->input->post("pasSenha");
                $dadosForm["email"] = $this->input->post("txtEmail");
                $dadosForm["ativo"] = 1;
                
                // Enviar os dados para função cadastracliente
                $this->clientes->addCliente($dadosForm);
            }
            

            redirect("/clientes/");

        }


    }
    
    public function editacliente($id = NULL)
    {
	//Verifica se foi passado um ID, se não vai para a página listar clientes
	if($id == NULL) {
		redirect('/clientes/');
	}

	//Faz a consulta no banco de dados pra verificar se existe
	$query = $this->clientes->getClienteByID($id);

	//Verifica que a consulta voltar um registro, se não vai para a página listar clientes
	if($query == NULL) {
		redirect('/clientes/');
	}
	
	//Guarda dados dos clientes
	$dados['clientes'] = $query;

	//Carrega a View
        $dados["titulo"] = "SYSOT - Cliente Novo";
        $this->load->view('includes/header',$dados);
        $this->load->view('includes/menu');
        $this->load->view('pages/clientes/editacliente');
        $this->load->view('includes/footer');

        }
        
        //Função Apagar cliente
	public function excluicliente($id=NULL)
	{

            // Model para carregar pedidos
            $this->load->model('pedidos_model','pedidos');

            //Verifica se foi passado um ID, se não vai para a página listar clientes
            if($id == NULL) {
                redirect('/clientes/');
            }

            //Consulta no banco de dados pra verificar se existe
            $query = $this->clientes->getClienteByID($id);

            // Busca dados dos pedidos do cliente
            $query2 = $this->pedidos->getPedidosByCliente($id);

            //Verifica se foi encontrado um registro com a ID passada
            if($query != NULL && $query2 == NULL) {

                //Executa a função Clientes_model
                $this->clientes->apagaCliente($query->id);

                redirect('/clientes/');

            } else {

                // Mensagem para o redirect
                $_SESSION["mensagem"] = "Cliente já fez um pedido.";
                
                redirect('/clientes/');
            }
                

	}
        
        
        //Função Apagar clientes em LOTE
	public function exluiclienteLOTE()
	{

            // Model para carregar pedidos
            $this->load->model('pedidos_model','pedidos');
            
            // Recebe ids dos clientes que serão apagados
            $listaID = $this->input->post('chkDeleta');
            
            //Verifica se foi passado um ID, se não vai para a página listar clientes
            if($listaID == NULL) :
                
                redirect('/clientes/');
            
            else:
                
                $_SESSION["mensagem"] = "";
                
                foreach ($listaID as $id){

                    // Busca dados dos pedidos do cliente
                    $query = $this->pedidos->getPedidosByCliente($id);
   
                    //Verifica se foi encontrado um registro com a ID passada
                    if($query == NULL) {

                        //Executa a função Clientes_model
                        $this->clientes->apagaCliente($id);

                    } else {

                        // Mensagem para o redirect
                        $_SESSION["mensagem"] =  $_SESSION["mensagem"] . "<br>Cliente ID $id já fez um pedido.";

                    }

                };
                
                redirect('/clientes/');
                
            endif;

	}

}
