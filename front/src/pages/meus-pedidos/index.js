import React, {useEffect,useState} from 'react';
import {Link , useHistory} from 'react-router-dom';
import Navegacao from '../../components/nav';
import {FiEdit2, FiTrash2}from'react-icons/fi';
import Api from '../../services/api';
import ErroApi from '../../services/erroApi'
import './styles.css';

export default function MeusPedidos() {
  const user = localStorage.getItem('user-name');
  const token = localStorage.getItem('token');
  const history = useHistory();

  const [produtos, setProdutos] = useState([]);

   
  useEffect(()=>{
      Api.get('request-of-product/products-user/',{
          headers: {"Authorization" : `Bearer ${token}`} 
      }).then((response)=>{

         setProdutos(response.data.Product)

      }).catch((error)=>{
          ErroApi(error);
          history.push('/')
      })
  },[token]);

  async function deletePedidos(id){//função que deleta o pedido 
     try {
        await Api.delete(`request-of-product/${id}`,{ headers: {"Authorization" : `Bearer ${token}`}} );
        setProdutos(produtos.filter(produto => produto.id!==id )); //aqui e atualizado o state sem o produto excluido

     } catch (error) {
            ErroApi(error);
            history.push('/');
     }   
  }


  async function requestproduct(id){  //função que finaliza o pedido
      try {
         const data={
            status:"Produto em roda de entrega",
            product_id:id
         }
         await Api.put(`request-of-product/${id}`,data,{ headers: {"Authorization" : `Bearer ${token}`}} );
         window.location.reload();

      } catch (error) {
            ErroApi(error);
            history.push('/');
      } 
  }

  return (
   <div className='conteiner-home'>
       <Navegacao  meusPedidos="active" />{/* Menu de navegação  */}
        <header>
           <span>Bem Vindo {user}</span>
        </header>
        <h1> Meus Pedidos</h1>

        <ul className="card">
           {
             produtos.map((produto)=>{ // listando todos os produtos com o map
                return(
                        <li key={produtos.id}>
                        <strong> Titulo:</strong>
                        <p>{produto.title}</p>
         
                        <strong>Descriçao:</strong>
                        <p>{produto.description}</p>
                        
                        <strong>Valor:</strong>
                        <p>R$ {produto.price}</p>
         
                        <strong>status:</strong>
                        <p>{produto.pivot.status}</p>

                        {/* A condcional abaixo serve para direfenciar o produto em aberto do produto finalizado,exibindo  os butões "Finalizar Compra" e "Pedido Finalizado" */}
                        {produto.pivot.status=="Em Aberto "? 
                            <>
                              <div className='options'>
                                <button type='button' onClick={() => deletePedidos(produto.id)}><FiTrash2 size={20} color='red' />Cancelar Pedido</button>
                              </div>
                                <button className='button' onClick={()=>requestproduct(produto.id)} style={{width: '40%',float:'right', backgroundColor:"#e0d51b"}}>
                                    Finalizar Compra
                                </button>
                            </>
                            :
                            <button className='button' disabled  style={{width: '40%',float:'right', backgroundColor:"green"}}>
                                Pedido Finalizado
                            </button>
                       }
                     </li>
                )
             })
           }
        </ul>
       
  </div>  
  );
}
