import React,{useState,useEffect} from 'react';
import{FiArrowLeft}from 'react-icons/fi';
import {Link,useHistory} from 'react-router-dom';
import Api from '../../services/api';
import ErroApi from '../../services/erroApi';

import'./styles.css';
import error from '../../services/erroApi';

export default function NovoUsuario(pros) {

    const {id}=pros.match.params;
    
   
    const [name,setName]=useState('');// states hooks  variaveis principais da aplicação
    const [email,setEmail]=useState('');
    

    const token = localStorage.getItem('token');
    const history = useHistory();


    useEffect(()=>{ // ação executada antes de montar o componet em tela 
       Api.get(`users/${id}`,{headers:{"Authorization" : `Bearer ${token}`} })
       .then((response)=>{

        console.log(response)
              setName(response.data.user.name)
              setEmail(response.data.user.email)
             
       }).catch((error)=>{
    
            ErroApi(error)
            history.push('/');
       }) 
      
    },[])
   
    async function handleNewProduct(e) {
        e.preventDefault()

      const data ={
          name,
          email,
      }

      try{
         
         await Api.put(`/users/${id}`,data, {headers: {"Authorization" : `Bearer ${token}`} } ) 
         alert('Atualizado com sucesso');
         history.push('/listar-usuarios/'); 
        
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
                   
                        <input value={name}  onChange={e=>{setName(e.target.value)}} type="text" placeholder="Nome"/>
                        <input value={email}  onChange={e=>{setEmail(e.target.value)}} type="text" placeholder="Email"/>
                        
                    <button className='button' type='submit' >Editar</button>
              </form>
          </div>
      </div>
  );
}
