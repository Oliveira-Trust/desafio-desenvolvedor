import { StatusService } from 'src/app/shared/services/status.service';
import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { PedidoService } from 'src/app/shared/services/pedido.service';
import { faSearch } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-busca-pedido',
  templateUrl: './busca-pedido.component.html',
  styleUrls: ['./busca-pedido.component.scss']
})
export class BuscaPedidoComponent implements OnInit {

  @Input() titulo: string;
  @Output() listarPedidos = new EventEmitter();
  statuses: any;
  pedidoForm: FormGroup;
  faSearch = faSearch;

  constructor(private fb: FormBuilder, private statusService: StatusService, private pedidoService: PedidoService) {}

  ngOnInit() {
    this.pedidoForm = this.fb.group({
     id : [''],
     cliente : [''],
     status_id : [''],
     total : [''],
    });

    this.statusService.buscar({}).subscribe((res) => {
      this.statuses = res.data;
    });

    this.buscar({});
  }

  buscar(pedido: any) {
    this.pedidoService
      .buscar(pedido)
      .subscribe(res => {
        this.listarPedidos.emit(res);
    });
  }

}
