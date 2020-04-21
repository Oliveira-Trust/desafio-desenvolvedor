import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from './../shared/shared.module';

import { AdminRoutingModule } from './admin-routing.module';
import { AdminComponent } from './admin.component';
import { ModalApagarComponent } from '../shared/components/modal-apagar/modal-apagar.component';
import { NavbarComponent } from './components/navbar/navbar.component';

import { ClientesComponent } from './pages/clientes/clientes.component';
import { ListaClientesComponent } from './pages/clientes/components/lista-clientes/lista-clientes.component';
import { BuscaClienteComponent } from './pages/clientes/components/busca-cliente/busca-cliente.component';
import { ModalClienteComponent } from './pages/clientes/components/modal-cliente/modal-cliente.component';

import { ProdutosComponent } from './pages/produtos/produtos.component';
import { ListaProdutoComponent } from './pages/produtos/components/lista-produto/lista-produto.component';
import { BuscaProdutoComponent } from './pages/produtos/components/busca-produto/busca-produto.component';
import { ModalProdutoComponent } from './pages/produtos/components/modal-produto/modal-produto.component';

import { PedidosComponent } from './pages/pedidos/pedidos.component';
import { ListaPedidoComponent } from './pages/pedidos/components/lista-pedido/lista-pedido.component';
import { BuscaPedidoComponent } from './pages/pedidos/components/busca-pedido/busca-pedido.component';
import { ModalPedidoComponent } from './pages/pedidos/components/modal-pedido/modal-pedido.component';
import { ModalAvisoComponent } from '../shared/components/modal-aviso/modal-aviso.component';

@NgModule({
  declarations: [
    AdminComponent,
    NavbarComponent,
    ClientesComponent,
    ListaClientesComponent,
    BuscaClienteComponent,
    ModalClienteComponent,
    ProdutosComponent,
    BuscaProdutoComponent,
    ListaProdutoComponent,
    ModalProdutoComponent,
    PedidosComponent,
    BuscaPedidoComponent,
    ListaPedidoComponent,
    ModalPedidoComponent
  ],
  imports: [CommonModule, AdminRoutingModule, SharedModule],
  exports: [],
  entryComponents: [
    ModalAvisoComponent,
    ModalApagarComponent,
    ModalClienteComponent,
    ModalProdutoComponent,
    ModalPedidoComponent,
  ]
})
export class AdminModule {}
