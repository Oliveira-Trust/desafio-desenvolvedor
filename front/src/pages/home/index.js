import React, {useEffect,useState} from 'react';
import {Link , useHistory} from 'react-router-dom';
import Navegacao from '../../components/nav';
import {FiEdit2, FiTrash2, FiSearch, FiLifeBuoy}from'react-icons/fi';
import Api from '../../services/api';
import ErroApi from '../../services/erroApi'
import './styles.css';

export default function Home() {
  const user = localStorage.getItem('user-name');
  const token = localStorage.getItem('token');
  const history = useHistory();

  const [produtos, setProdutos] = useState([]);

   
  useEffect(()=>{
      Api.get('products',{
          headers: {"Authorization" : `Bearer ${token}`} 
      }).then((response)=>{
        console.log(response.data)
         setProdutos(response.data.data)

      }).catch((error)=>{
          ErroApi(error);
          history.push('/')
      })
  },[token]);


  async function deleteProdutos(id){
     try {
        await Api.delete(`/products/${id}`,{ headers: {"Authorization" : `Bearer ${token}`}} );
        setProdutos(produtos.filter(produto => produto.id!==id ));

     } catch (error) {
            ErroApi(error);
            history.push('/');
     }   
  }

  function goToEditProduct(id) {
     history.push('/edit-produto/'+id)
  }


  async function requestproduct(id){
      try {
         const data={
            status:"Em Aberto ",
            user_id:localStorage.getItem('user-id'),
            product_id:id
         }
         await Api.post(`request-of-product`,data,{ headers: {"Authorization" : `Bearer ${token}`}} );
      
         history.push('/meus-pedidos/');

      } catch (error) {
            ErroApi(error);
            history.push('/');
      } 
  }

  async function pesquisaProduct() {
     let dataPesquisa = document.querySelector('#pesquisa').value;
     
     try {
       let response=await Api.get(`/products/pesquise?title=${dataPesquisa}`,{ headers: {"Authorization" : `Bearer ${token}`}})

       setProdutos(response.data.data)

     } catch (error) {
         ErroApi(error);
         history.push('/');
     }

   }
     
  return (
   <div className='conteiner-home'>
       <Navegacao  home="active" />
        <header>
           <span>Bem Vindo {user}</span>
        </header>
         <div className ="barra-de-pesquisa">
            <h1> Lista de Produtos</h1>
            <div className='pesquisa-content'>
               <input type="text" placeholder="Pesquise" id='pesquisa'/>
               <button type='button' onClick={()=>pesquisaProduct()} ><FiSearch size={20}  color="#a8a8b3"/></button>
           </div>
         </div>
        
        <ul className="card">
           {
             produtos.map((produto)=>{
                return(
                        <li key={produtos.id}>
                        <strong> Titulo:</strong>
                        <p>{produto.title}</p>
         
                        <strong>Descriçao:</strong>
                        <p>{produto.description}</p>
                        
                        <strong>Valor:</strong>
                        <p>R$ {produto.price}</p>
         
                        <div className='options'>
                           <button type='button' onClick={() => goToEditProduct(produto.id)} ><FiEdit2 size={20}  color="#a8a8b3"/></button>
                           <button type='button' onClick={() => deleteProdutos(produto.id)}><FiTrash2 size={20} color='#a8a8b3' /></button>
                        </div>
                        <button className='button' onClick={()=>requestproduct(produto.id)} style={{width: '40%',float:'right'}}>Eu Quero</button>
                     </li>
                )
             })
           }
        </ul>
        <div class="pagination">
            <a href="#">&laquo;</a>
            
            <a href="#" class="active">2</a>
            
            <a href="#">&raquo;</a>
       </div>
  </div>  
  );
}
