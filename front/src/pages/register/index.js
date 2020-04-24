import React,{useState} from 'react';
import{FiArrowLeft}from 'react-icons/fi';
import {Link , useHistory} from 'react-router-dom';

import Api from '../../services/api'

import'./styles.css';


export default function Register() {

    const [name, setName]=useState('');
    const [email, setEmail]=useState('');
    const [password, setPassword]=useState('');
    const [password_confirmation, setPassword_confirmation]=useState('');

    const history = useHistory();
    
   async function handleRegister(e){
        e.preventDefault()
        const data = {
            name,
            email,
            password,
            password_confirmation
        }
       try{
          await Api.post('register',data)
          alert("Cadastrado com sucesso")
          history.push('/');

       }catch(err){
          alert('Houve um erro, repita o processo mais tarde ')
       }
       
    }
  return (
      <div className="register-conteiner">
          <div className="conteiner">
              <section>
                <h1 className='logo'>Produtos Aleatorios</h1>
                <h2>Cadastro</h2>
                <p>Faça seu cadastro na melhor plataforma de produtos aleatorios do mundo !</p>

                 <Link className='back-link' to='/'>
                    <FiArrowLeft size={16} color="#e24608" />
                    Voltar
                 </Link>
              </section>
              <form onSubmit={handleRegister}>

                   <input value={name}  onChange={e=>setName(e.target.value)} type="text" placeholder="Seu Nome"/>
                    <input type="email"  value={email}  onChange={e=>setEmail(e.target.value)}  placeholder="E-mail"/>
                   
                    <div className="grup-input">
                        <input type="password"  value={password}  onChange={e=>setPassword(e.target.value)} placeholder="Senha"/>
                        <input type="password"  value={password_confirmation}  onChange={e=>setPassword_confirmation(e.target.value)} placeholder="Confirme a senha  "/>
                    </div>
                    
                    <button className='button' type='submit' >Cadastrar</button>
              </form>
          </div>
      </div>
  );
}
