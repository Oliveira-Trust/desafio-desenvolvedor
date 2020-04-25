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
  const [page, setPage] = useState('');
  const [lastPage, setLastPage] = useState([]);

   
  useEffect(()=>{ // pega todos o pedidos antes de montar o html
      Api.get('products',{
          headers: {"Authorization" : `Bearer ${token}`} 
      })
      .then((response)=>{
       
         setProdutos(response.data.data)
         setPage(response.data.current_page)
         setLastPage(response.data.last_page)

      })
      .catch((error)=>{
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

  async function paginacao(pag) {
   let next = page +pag
   setPage(next)

   await Api.get(`products?page=${next}`,{
      headers: {"Authorization" : `Bearer ${token}`} 
      })
      .then((response)=>{
         
         setProdutos(response.data.data)
         setPage(response.data.current_page)
         setLastPage(response.data.last_page)

      })
      .catch((error)=>{
            ErroApi(error);
            history.push('/')
      })

 }

  async function pesquisaProduct() {
     let dataPesquisa = document.querySelector('#pesquisa').value;
     
     try {
       let response=await Api.get(`/products/pesquise?title=${dataPesquisa}`,{ headers: {"Authorization" : `Bearer ${token}`}})

       setProdutos(response.data.data)
       setPage(response.data.current_page)
       setLastPage(response.data.last_page)

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
          <Link className="button" to='/cadastrar-produto/'>Cadastrar Novo Produto</Link>
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
                           <Link to={`/edit-produto/${produto.id}`}>
                              <button type='button'>
                                 <FiEdit2 size={20}  color="#a8a8b3"/>
                              </button>
                           </Link>
                           <button type='button' onClick={() => deleteProdutos(produto.id)}>
                              <FiTrash2 size={20} color='#a8a8b3' />
                           </button>
                        </div>
                        <button className='button' onClick={()=>requestproduct(produto.id)} style={{width: '40%',float:'right'}}>
                           Eu Quero
                        </button>
                     </li>
                )
             })
           }
        </ul>
        <div class="pagination">
            {page > 1 ? <a onClick={()=>paginacao(-1)} >&laquo;</a> : ""}
               <a href="#" class="active">{page}</a>
            {page != lastPage ? <a onClick={()=>paginacao(1)}>&raquo;</a> : ""}
       </div>
  </div>  
  );
}
