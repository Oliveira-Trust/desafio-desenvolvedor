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
  const [page, setPage] = useState([]);
  const [lastPage, setLastPage] = useState([]);


   
  useEffect(()=>{
      Api.get('users',{
          headers: {"Authorization" : `Bearer ${token}`} 
      }).then((response)=>{
        
         
         setUsuarios(response.data.users.data)
         setPage(response.data.users.current_page)
         setLastPage(response.data.users.last_page)

      }).catch((error)=>{
          ErroApi(error);
          history.push('/')
      })
  },[token]);


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


  async function paginacao(pag) {
   let next = page +pag
   setPage(next)

   await Api.get(`users?page=${next}`,{
      headers: {"Authorization" : `Bearer ${token}`} 
      })
      .then((response)=>{
         
         setUsuarios(response.data.users.data)
         setPage(response.data.users.current_page)
         setLastPage(response.data.users.last_page)

      })
      .catch((error)=>{
            ErroApi(error);
            history.push('/')
      })

 }

  return (
   <div className='conteiner-home'>
       <Navegacao  listaUsuario="active" />
        <header>
           <span>Bem Vindo {user}</span>
           <Link className="button" to='/cadastrar-usuario/'>Cadastrar Novo Usuario</Link>
        </header>

        <h1> Lista de usuarios</h1>

        <ul className="card">
           {
             usuarios.map((usuario)=>{
                return(
                        <li key={usuario.id}>
                        <strong> Nome:</strong>
                        <p>{usuario.name}</p>
         
                        <strong>Email:</strong>
                        <p>{usuario.email}</p>
         
                       
                        <div className='options'>
                           <Link to={`/edit-usuario/${usuario.id}`}>
                              <button type='button' onClick={() => goToEditUser(usuario.id)} >
                                 <FiEdit2 size={20}  color="#a8a8b3"/>
                               </button>
                           </Link>
                           <button type='button' onClick={() => deleteUsuarios(usuario.id)}><FiTrash2 size={20} color='#a8a8b3' /></button>
                        </div>
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
