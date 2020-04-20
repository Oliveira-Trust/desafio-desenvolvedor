import { NgModule } from '@angular/core';
import { HttpClientModule } from '@angular/common/http';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { ModalModule } from 'ngx-bootstrap/modal';
import { LoadingComponent } from './components/loading/loading.component';
import { ErrorComponent } from './components/error/error.component';
import { ModalApagarComponent } from './components/modal-apagar/modal-apagar.component';


@NgModule({
  declarations: [LoadingComponent, ErrorComponent, ModalApagarComponent],
  imports: [
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    FontAwesomeModule,
    ModalModule.forRoot(),
  ],
  exports: [
    HttpClientModule,
    FormsModule,
    ReactiveFormsModule,
    FontAwesomeModule,
    ModalModule,
    LoadingComponent,
    ErrorComponent
  ]
})
export class SharedModule {
}
