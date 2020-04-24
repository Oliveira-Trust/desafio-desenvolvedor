import React,{useState} from 'react';
import {Link, useHistory} from 'react-router-dom'
import Cat from '../../assets/cat.jpg';
import{FiLogIn}from 'react-icons/fi'
import Api from '../../services/api'

import './styles.css';

export default function Login() {

  const [email,setEmail]=useState('')
  const [password,setPassword]=useState('')
  const history=useHistory()

   async function handleLogin(e) {

    e.preventDefault()

     const data={
       email,
       password
     }
      try {
          const response= await Api.post('login', data)
         
          localStorage.setItem('token',response.data.token)
          localStorage.setItem('type_token',response.data.token_type)
          localStorage.setItem('user-name',response.data.user.name)
          localStorage.setItem('user-id',response.data.user.id)

          history.push('/home/')

      } catch (error) {
         console.log(error)
         alert('Houve um erro tente mais tarde')
      }
  }
  return (
    <div className="conteiner-login">
      <section className="form">
       <h1 className='logo'>Produtos Aleatorios</h1>
       
       <form onSubmit={handleLogin}>
          <h1 >Faça seu Login</h1>
          
          <input value={email} onChange={e=>setEmail(e.target.value)} placeholder="Email"/>
          <input value={password} onChange={e=>setPassword(e.target.value)} placeholder="Senha" type='password'/>
          <button className="button"  type='submit'>Entrar</button>

          <Link className='back-link' to='/register'>
            <FiLogIn size={16} color="#e24608" />
            Não tenho Cadastro
          </Link>
          
          
       </form>

      </section>

      <img src={Cat} alt='Produtos Aleatorios'></img>
    </div>
  );
}
