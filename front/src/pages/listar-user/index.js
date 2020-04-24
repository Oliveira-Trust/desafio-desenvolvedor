import React, {useEffect,useState} from 'react';
import {Link , useHistory} from 'react-router-dom';
import Navegacao from '../../components/nav';
import {FiEdit2, FiTrash2}from'react-icons/fi';
import Api from '../../services/api';
import ErroApi from '../../services/erroApi'
import './styles.css';

export default function Usuarios() {
  const user = localStorage.getItem('user-name');
  const token = localStorage.getItem('token');
  const history = useHistory();

  const [usuarios, setUsuarios] = useState([]);

   
  useEffect(()=>{
      Api.get('users',{
          headers: {"Authorization" : `Bearer ${token}`} 
      }).then((response)=>{
        
         setUsuarios(response.data.users)

      }).catch((error)=>{
          ErroApi(error);
        //   history.push('/')
      })
  },[token]);

  console.log(usuarios)
  async function deleteUsuarios(id){
     try {
        await Api.delete(`/users/${id}`,{ headers: {"Authorization" : `Bearer ${token}`}} );
        setUsuarios(usuarios.filter(usuario => usuario.id!==id ));

     } catch (error) {
            ErroApi(error);
            // history.push('/');
     }   
  }

  function goToEditUser(id) {
     history.push('/edit-usuario/'+id)
  }

  return (
   <div className='conteiner-home'>
       <Navegacao  listaUsuario="active" />
        <header>
           <span>Bem Vindo {user}</span>
           
        </header>

        <h1> Lista de usuarios</h1>

        <ul className="card">
           {
             usuarios.map((usuario)=>{
                return(
                        <li key={usuarios.id}>
                        <strong> Nome:</strong>
                        <p>{usuario.name}</p>
         
                        <strong>Email:</strong>
                        <p>{usuario.email}</p>
         
                       
                        <div className='options'>
                           <button type='button' onClick={() => goToEditUser(usuario.id)} ><FiEdit2 size={20}  color="#a8a8b3"/></button>
                           <button type='button' onClick={() => deleteUsuarios(usuario.id)}><FiTrash2 size={20} color='#a8a8b3' /></button>
                        </div>
                     </li>
                )
             })
           }
        </ul>
       
  </div>  
  );
}
