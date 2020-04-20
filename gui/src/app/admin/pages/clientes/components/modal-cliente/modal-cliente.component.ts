import { Component, OnInit, ViewChild, Output, EventEmitter } from '@angular/core';
import { BsModalRef } from 'ngx-bootstrap/modal';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ClienteService } from 'src/app/shared/services/cliente.service';
import { faSave } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-modal-cliente',
  templateUrl: './modal-cliente.component.html',
  styleUrls: ['./modal-cliente.component.scss']
})
export class ModalClienteComponent implements OnInit {

  @Output() action = new EventEmitter();
  tituloModal: string;
  conteudoModal: any;
  faSave = faSave;
  clienteForm: FormGroup;
  enviado = false;

  constructor(
    public bsModalRef: BsModalRef,
    private fb: FormBuilder,
    private clienteService: ClienteService
  ) {
    this.clienteForm = this.fb.group({
      id : [''],
      nome : ['', Validators.required],
      sobrenome : ['', Validators.required],
      email : ['', [Validators.required, Validators.email]]
     });
  }

  get f() { return this.clienteForm.controls; }

  ngOnInit() {
    if (this.conteudoModal !== null) {
      console.log(this.conteudoModal);
      this.clienteForm.patchValue(this.conteudoModal);
    }
  }

  salvar() {

    this.enviado = true;

    // stop here if form is invalid
    console.log('1', this.clienteForm.valid, this.clienteForm.invalid);
    if (this.clienteForm.invalid) {
        return;
    }

    const cliente = this.clienteForm.value;
    console.log(2);
    this.clienteService.salvar(cliente).subscribe((res) => {
      this.bsModalRef.hide();
      this.action.emit(true);
    });
  }

}
