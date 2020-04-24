import React from 'react';
import {BrowserRouter,Route, Switch}from 'react-router-dom';
import Login from './pages/login';
import Register from './pages/register';
import Home from './pages/home';
import NovoProduto from './pages/novo-produto';
import NovoUsuario from './pages/novo-usuario';
import EditProduto from './pages/editar-produto';
import ListarUser from './pages/listar-user';
import EditarUser from './pages/listar-user';
import MeusPedidos from './pages/meus-pedidos';

export default function Routes(){
   
   return( <BrowserRouter>
     <Switch>
       <Route path='/' component={Login} exact />;
       <Route path='/register/' component={Register}  />;
       <Route path='/home/' component={Home}  />;
       <Route path='/listar-usuarios/' component={ListarUser}  />;
       <Route path='/cadastrar-produto/' component={NovoProduto} />;
       <Route path='/cadastrar-usuario/' component={NovoUsuario} />;
       <Route path='/edit-produto/:id' component={EditProduto} />;
       <Route path='/edit-usuario/' component={EditarUser} />;
       <Route path='/meus-pedidos/' component={MeusPedidos} />;
       <Route path='/edit-produto/' component={EditProduto} />;
     </Switch>
    </BrowserRouter>
   );
}