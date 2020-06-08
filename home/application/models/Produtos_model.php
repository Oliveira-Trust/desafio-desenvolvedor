<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<?php
class Produtos_model extends CI_Model
{
    
    public function getProdutos($ordem)
    {
        
        $query = $this->db->select("*")
          ->from("produtos p")
          ->order_by("p.$ordem", "ASC")
          ->get();
    
        return $query->result();
        
    } 
    
    public function getDescricaoProdutos()
    {
        
        $query = $this->db->select("*")
          ->from("produtos p")
          ->order_by("p.descricao", "ASC")
          ->get();
    
        return $query->result();
        
    } 
    
    public function addProduto($dados=NULL) 
    {
        
        if($dados!=NULL):
            
            $this->db->insert('produtos',$dados);
        
        endif;
        
    }
    
    public function getProdutoById($id=NULL)
    {
    
        if ($id != NULL):
            //Verifica se a ID no banco de dados
            $this->db->where('id', $id);
            //limita para apenas um produto    
            $this->db->limit(1);
            //pega os cliente
            $query = $this->db->get("produtos");
            //retornamos o produto
            return $query->row();
        endif;
        
    } 
    
    //Atualizar um produto na tabela produtos
    public function editaProduto($dados=NULL, $id=NULL)
    {
    //Verifica se foi passado $dados e $id    
    if ($dados != NULL && $id != NULL):
        //Se foi passado ele vai a atualização
        $this->db->update('produtos', $dados, array('id'=>$id));      
    endif;
    }  
    
    //Apaga um produto na tabela produtos 
    public function apagaProduto($id=NULL){
        //Verificamos se foi passado o a ID como parametro
        if ($id != NULL):
            //Executa a função DB DELETE para apagar o produto
            $this->db->delete('produtos', array('id'=>$id));            
        endif;
    } 
    
}

?>