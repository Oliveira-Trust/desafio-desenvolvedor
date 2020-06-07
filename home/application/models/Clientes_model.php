<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php
class Clientes_model extends CI_Model
{
    
    public function getClientes()
    {
    
        $query = $this->db->get('clientes');
        return $query->result();
        
    } 
    
    public function addCliente($dados=NULL) 
    {
        
        if($dados!=NULL):
            
            $this->db->insert('clientes',$dados);
        
        endif;
        
    }
    
    public function getClienteById($id=NULL)
    {
    
        if ($id != NULL):
            //Verifica se a ID no banco de dados
            $this->db->where('id', $id);
            //limita para apenas um cliente    
            $this->db->limit(1);
            //pega os cliente
            $query = $this->db->get("clientes");
            //retornamos o cliente
            return $query->row();
        endif;
        
    } 
    
}

?>