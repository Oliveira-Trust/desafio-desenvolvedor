import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AdminComponent } from './admin.component';
import { ClientesComponent } from './pages/clientes/clientes.component';
import { ProdutosComponent } from './pages/produtos/produtos.component';
import { PedidosComponent } from './pages/pedidos/pedidos.component';
import { ErrorComponent } from './../shared/components/error/error.component';
import { AuthGuardChildService } from '../guards/auth-guard-child.service';

const routes: Routes = [
  {
    path: '',
    component: AdminComponent,
    canActivateChild: [AuthGuardChildService],
    children: [
      { path: '', redirectTo: 'clientes', pathMatch: 'full' },
      {
        path: 'clientes',
        component: ClientesComponent
      },
      {
        path: 'produtos',
        component: ProdutosComponent
      },
      {
        path: 'pedidos',
        component: PedidosComponent
      },
      { path: '**', component: ErrorComponent }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AdminRoutingModule {
}
