import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SharedModule } from './../shared/shared.module';

import { AcessoRoutingModule } from './acesso-routing.module';
import { AcessoComponent } from './acesso.component';
import { LoginComponent } from './pages/login/login.component';

@NgModule({
  declarations: [
    AcessoComponent,
    LoginComponent
  ],
  imports: [CommonModule, AcessoRoutingModule, SharedModule],
  exports: []
})
export class AcessoModule {}
