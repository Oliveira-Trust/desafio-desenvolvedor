<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sysot extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->helper('url');

    }

    public function index()
    {

        $dados["titulo"] = "Home";
        $this->load->view('includes/header',$dados);
        $this->load->view('pages/index');
        $this->load->view('includes/footer');
    }
    
    // Chama formulário de autenticação
    public function autentica()
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('usuario','Usuário','trim|required|numeric|exact_length[6]');
        $this->form_validation->set_rules('senha','Senha','trim|required|numeric|exact_length[6]');
        if ( $this->form_validation->run() == FALSE ){
            $dados["formerror"] = validation_errors();
        }else{
            $dados["formerror"] = NULL;
        }

        $dados["titulo"] = "Formulário de autenticação";
        $this->load->view('includes/header',$dados);
        $this->load->view('pages/autentica');
        $this->load->view('includes/footer');
    }
    
    // Chama formulário de autenticação
    public function valida()
    {

        $dados["titulo"] = "SYSOT";
        $this->load->view('includes/header',$dados);
        $this->load->view('includes/menu');
        $this->load->view('pages/inicial');
        $this->load->view('includes/footer');
    }
}
