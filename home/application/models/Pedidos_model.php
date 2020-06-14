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
    
    public function getPedidosByCliente($idCliente)
    {

        $query = $this->db->select("*, p1.id as idPedido")
                  ->from("pedidos p1")
                  ->join('clientes c', 'p1.idClientes = c.id')
                  ->join('produtos p2', 'p1.idProdutos = p2.id')
                  ->where('p1.idClientes', $idCliente)
                  ->get();

        return $query->result();
        
    } 
    
    public function getPedidosByIdProduto($idProduto)
    {

        $query = $this->db->select("*")
                  ->from("pedidos p1")
                  ->join('clientes c', 'p1.idClientes = c.id')
                  ->join('produtos p2', 'p1.idProdutos = p2.id')
                  ->where('p1.idProdutos', $idProduto)
                  ->get();

        return $query->result();
        
    } 
    
    public function getPedidosById($id)
    {

        $query = $this->db->select("*")
                  ->from("pedidos")
                  ->where('id', $id)
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
    
    
    //Atualizar um pedido na tabela pedidos
    public function editaPedido($dados=NULL, $id=NULL)
    {
    //Verifica se foi passado $dados e $id    
    if ($dados != NULL && $id != NULL):
        
        echo "<script>alert('".$dados."')</script>";
        
        //Se foi passado ele vai a atualização
        return $this->db->update('pedidos', $dados, array('id'=>$id));
    
    endif;
    }  
    
    
    //Apaga um pedido na tabela pedidos 
    public function apagaPedido($id=NULL){
        //Verificamos se foi passado o a ID como parametro
        if ($id != NULL):
            //Executa a função DB DELETE para apagar o pedido
            $this->db->delete('pedidos', array('id'=>$id));
        endif;
    } 
    
}

?>