import React from 'react';
import {Link,useHistory} from 'react-router-dom';

import './styles.css';

export default function Navegacao(props) {

const history=useHistory()
  function handleLogout() {
    localStorage.clear()
    history.push('/');

  }
  return (
    <nav>
    <h1 className="logo">Produtos aleatorios</h1>
        <ul>
          <li><Link className={props.home}  to="/home/">Home</Link></li>
          <li><Link className={props.novoUsuario}  to="/cadastrar-usuario/">Novo Usuario</Link></li>
          <li><Link className={props.novoProduto}  to="/cadastrar-produto/">Novo Produto</Link></li>
          <li><Link className={props.listaUsuario}  to="/listar-usuarios/">Listar Usuarios</Link></li>
          <li><Link className={props.meusPedidos}  to="/meus-pedidos/">Meus Pedidos</Link></li>
          <li className="logout" onClick={handleLogout}> <a>Sair</a></li>
        </ul>
    </nav>
  );
}
