<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php
class Pedidos_model extends CI_Model
{
    
    public function getPedidos($ordem)
    {

        $query = $this->db->select("*, p1.id as idPedido")
                  ->from("pedidos p1")
                  ->join('clientes c', 'p1.idClientes = c.id')
                  ->join('produtos p2', 'p1.idProdutos = p2.id')
                  ->order_by("$ordem", "ASC")
                  ->order_by("c.nome", "ASC")
                  ->get();

        return $query->result();
        
    } 
    
    public function addPedido($dados=NULL) 
    {
        
        if($dados!=NULL):
            
            $this->db->insert('pedidos',$dados);
        
        endif;
        
    }
    
    public function getPedidoById($id=NULL)
    {
    
        if ($id != NULL):
            
            $query = $this->db->select("*, p1.id as idPedido")
                  ->from("pedidos p1")
                  ->join('clientes c', 'p1.idClientes = c.id')
                  ->join('produtos p2', 'p1.idProdutos = p2.id')
                  ->where('p1.id', $id)
                  ->get();
            
            return $query->result();
                
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