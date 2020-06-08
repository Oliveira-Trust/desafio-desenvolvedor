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
    
    //Atualizar um cliente na tabela clientes
    public function editaCliente($dados=NULL, $id=NULL)
    {
    //Verifica se foi passado $dados e $id    
    if ($dados != NULL && $id != NULL):
        //Se foi passado ele vai a atualização
        $this->db->update('clientes', $dados, array('id'=>$id));      
    endif;
    }  
    
    //Apaga um cliente na tabela cliente 
    public function apagaCliente($id=NULL){
        //Verificamos se foi passado o a ID como parametro
        if ($id != NULL):
            //Executa a função DB DELETE para apagar o cliente
            $this->db->delete('clientes', array('id'=>$id));            
        endif;
    } 
    
}

?>