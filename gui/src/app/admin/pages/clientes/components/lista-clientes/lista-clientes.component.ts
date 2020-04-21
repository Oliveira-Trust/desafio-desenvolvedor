import { Component, OnInit, Input, ViewChild } from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';
import {
  faChevronUp,
  faChevronDown,
  faPlus,
  faPen,
  faTrashAlt
} from '@fortawesome/free-solid-svg-icons';
import { UtilProvider } from '../../../../../shared/providers/util.provider';
import { ClienteService } from 'src/app/shared/services/cliente.service';
import { ModalClienteComponent } from './../modal-cliente/modal-cliente.component';
import { ModalApagarComponent } from 'src/app/shared/components/modal-apagar/modal-apagar.component';
import { BuscaClienteComponent } from '../busca-cliente/busca-cliente.component';

@Component({
  selector: 'app-lista-clientes',
  templateUrl: './lista-clientes.component.html',
  styleUrls: ['./lista-clientes.component.scss']
})
export class ListaClientesComponent implements OnInit {
  bsModalRef: BsModalRef;
  @Input() titulo: string;
  @ViewChild(BuscaClienteComponent, { static: false }) busca: BuscaClienteComponent;
  qtdRegistros = 0;
  clientes = [];
  loading = true;
  sortOrder = 1;
  sortIcon = faChevronUp;
  faChevronUp = faChevronUp;
  faChevronDown = faChevronDown;
  faPlus = faPlus;
  faPen = faPen;
  faTrashAlt = faTrashAlt;

  constructor(
    private modalService: BsModalService,
    private clienteService: ClienteService
  ) {
    this.qtdRegistros = this.clientes.length;
  }

  ngOnInit() {
    this.setSortOrder(this.sortOrder);
  }

  buscarClientes(event: any) {
    this.clientes = event.data;
    this.qtdRegistros = event.data.length;
    this.loading = false;
  }

  executarAcao(obj, acao) {

    if (/i|a/.test(acao)) {
      this.abrirModal(obj, acao);
    } else {
      this.abrirAviso(obj);
    }

  }

  abrirModal(conteudo, acao) {

    const titulo = acao === 'i' ? 'Incluir Cliente' : `Editar Cliente ${conteudo.nome}`;

    const initialState = {
      tituloModal: `${titulo}`,
      conteudoModal: conteudo
    };

    this.bsModalRef = this.modalService.show(ModalClienteComponent, {
      initialState,
      class: 'gray modal-lg'
    });

    this.bsModalRef.content.action.subscribe((value) => {
      if (value) {
        this.busca.buscar({});
      }
    });
  }

  abrirAviso(obj) {

    const initialState = {
      tituloModal: 'Atenção!',
      conteudoModal: `Você está prestes a apagar o cliente ${obj.nome}! Tem certeza que deseja apagar?`
    };

    this.bsModalRef = this.modalService.show(ModalApagarComponent, {
      initialState,
      class: 'gray modal-lg'
    });

    this.bsModalRef.content.action.subscribe((value) => {
      if (value) {
        this.clienteService
          .apagar(obj)
          .subscribe((res) => {
            console.log(res);
          if (!res.error) {
            this.busca.buscar({});
          }
        });
      }
    });
  }

  setSortOrder(sortOrder) {
    this.sortOrder = sortOrder === 0 ? 1 : 0;
    this.sortIcon = sortOrder === 0 ? faChevronUp : faChevronDown;
  }

  ordenar(prop, sortOrder) {
    this.setSortOrder(sortOrder);
    UtilProvider.ordenar(this.clientes, prop, sortOrder);
  }
}
