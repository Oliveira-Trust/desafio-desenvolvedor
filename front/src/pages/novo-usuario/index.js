import React,{useState} from 'react';
import{FiArrowLeft}from 'react-icons/fi';
import {Link,useHistory} from 'react-router-dom';
import Api from '../../services/api';
import ErroApi from '../../services/erroApi';
import Navegacao from '../../components/nav';

import'./styles.css';
import error from '../../services/erroApi';

export default function NovoUsuario() {

    const [name,setName]=useState('');
    const [email,setEmail]=useState('');
    const [password,setPassword]=useState('');
    

    const token = localStorage.getItem('token');
    const history = useHistory();

    async function handleNewProduct(e) {
        e.preventDefault()

      const data ={
          name,
          email,
          password,
      }  
      try{
         let Response=await Api.post('/users',data, {headers: {"Authorization" : `Bearer ${token}`} } ) 
         console.log(Response)
         history.push('/listar-usuarios/'); 
        
      }catch(erro){

         ErroApi(error)
         history.push('/');
      }
     
    }
  return (
    <div className="conteiner-novo-usuario">
       <Navegacao novoUsuario="active" />
   
      <div className="novo-usuario-conteiner">
        
          <div className="novo-usuario-content">
              <section>
                <h1 className='logo'>Produtos Aleatorios</h1>
                <h2>Cadastro um Novo Usuario</h2>
                <p>Cadastre um novo usuario e descubra o poder da ferramenta  !</p>

                 <Link className='back-link' to='/home/'>
                    <FiArrowLeft size={16} color="#e24608" />
                    Voltar Para Home 
                 </Link>
              </section>
              <form onSubmit={handleNewProduct}>
                   
                   
                    <input value={name}  onChange={e=>{setName(e.target.value)}} type="text" placeholder="nome"/>
                    <input value={email}  onChange={e=>{setEmail(e.target.value)}} type="email" placeholder="email"/>
                    <input value={password} onChange={e=>{setPassword(e.target.value)}} type="text" placeholder="senha"/>

                    <button className='button' type='submit' >Cadastrar</button>
              </form>
          </div>
      </div>
      </div>
  );
}
