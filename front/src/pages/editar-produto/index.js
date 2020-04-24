import React,{useState,useEffect} from 'react';
import{FiArrowLeft}from 'react-icons/fi';
import {Link,useHistory} from 'react-router-dom';
import Api from '../../services/api';
import ErroApi from '../../services/erroApi';

import'./styles.css';
import error from '../../services/erroApi';

export default function NovoProduto(pros) {

    const {id}=pros.match.params;

   
    const [title,setTitle]=useState('');
    const [sub_title,setSubTitle]=useState('');
    const [description,setDescription]=useState('');
    const [price,setPrice]=useState('');


    const token = localStorage.getItem('token');
    const history = useHistory();

    useEffect(()=>{
       Api.get(`products/${id}`,{headers:{"Authorization" : `Bearer ${token}`} }).
       then((response)=>{
           setTitle(response.data.Product.title)
           setSubTitle(response.data.Product.sub_title)
           setDescription(response.data.Product.description)
           setPrice(response.data.Product.price)
           
       }).catch((error)=>{
           console.log(error)
            ErroApi(error)
            history.push('/');
       }) 
      
    },[])
   
    async function handleNewProduct(e) {
        e.preventDefault()

      const data ={
          title,
          sub_title,
          description,
          price,
          "url_image":"/public/imagem/01.png"
      }  
      try{
         let Response=await Api.put(`/products/${id}`,data, {headers: {"Authorization" : `Bearer ${token}`} } ) 
         console.log(Response)
         alert('Atualizado com sucesso');
         history.push('/home/'); 
        
      }catch(erro){

         ErroApi(error)
         history.push('/');
      }
    }
    
  return (
      <div className="novo-produto">
          <div className="conteiner">
              <section>
                <h1 className='logo'>Produtos Aleatorios</h1>
                <h2>Cadastro um Novo Produto</h2>
                <p>Cadastre um novo produto e descubra o poder da ferramenta  !</p>

                 <Link className='back-link' to='/home/'>
                    <FiArrowLeft size={16} color="#e24608" />
                    Voltar Para Home 
                 </Link>
              </section>
              <form onSubmit={handleNewProduct}>
                   
                    <div className="grup-input">
                        <input value={title}  onChange={e=>{setTitle(e.target.value)}} type="text" placeholder="Titulo"/>
                        <input value={sub_title}  onChange={e=>{setSubTitle(e.target.value)}} type="text" placeholder="Sub Titulo"/>
                    </div>
                    <textarea value={description} onChange={e=>{setDescription(e.target.value)}} placeholder="Descrição" />
                    <input value={price} onChange={e=>{setPrice(e.target.value)}} type="number" placeholder="Valor em reais"/>

                    <button className='button' type='submit' >Editar</button>
              </form>
          </div>
      </div>
  );
}
