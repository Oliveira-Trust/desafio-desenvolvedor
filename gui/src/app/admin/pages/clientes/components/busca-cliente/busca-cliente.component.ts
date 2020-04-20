import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ClienteService } from 'src/app/shared/services/cliente.service';
import { faSearch } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-busca-cliente',
  templateUrl: './busca-cliente.component.html',
  styleUrls: ['./busca-cliente.component.scss']
})
export class BuscaClienteComponent implements OnInit {

  @Input() titulo: string;
  @Output() listarClientes = new EventEmitter();
  clienteForm: FormGroup;
  faSearch = faSearch;

  constructor(private fb: FormBuilder, private clienteService: ClienteService) {}

  ngOnInit() {
    this.clienteForm = this.fb.group({
     id : ['', Validators.required],
     nome : ['', Validators.required],
     sobrenome : ['', Validators.required],
     email : ['', Validators.required],
    });

    this.buscar({});
  }

  buscar(cliente: any) {
    this.clienteService
      .buscar(cliente)
      .subscribe(res => {
        this.listarClientes.emit(res);
    });
  }

}
