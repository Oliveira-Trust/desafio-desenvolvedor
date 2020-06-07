<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produtos extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('CRUD_model','CRUD');
    }

    public function index()
    {

        $dados["titulo"] = "Home";
        $this->load->view('includes/header',$dados);
        $this->load->view('pages/produtos/index');
        $this->load->view('includes/footer');
    }

}
