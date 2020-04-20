import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { AcessoComponent } from './acesso.component';
import { LoginComponent } from './pages/login/login.component';
import { ErrorComponent } from '../shared/components/error/error.component';


const routes: Routes = [
  {
    path: '',
    component: AcessoComponent,
    children: [
      // { path: '', redirectTo: 'login', pathMatch: 'full' },
      {
        path: '',
        component: LoginComponent
      },
      { path: '**', component: ErrorComponent }
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AcessoRoutingModule {
}
