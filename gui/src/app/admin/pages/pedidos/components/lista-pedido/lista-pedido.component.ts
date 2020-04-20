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
import { BuscaPedidoComponent } from './../busca-pedido/busca-pedido.component';
import { PedidoService } from 'src/app/shared/services/pedido.service';
import { ModalPedidoComponent } from './../modal-pedido/modal-pedido.component';
import { ModalApagarComponent } from 'src/app/shared/components/modal-apagar/modal-apagar.component';


@Component({
  selector: 'app-lista-pedido',
  templateUrl: './lista-pedido.component.html',
  styleUrls: ['./lista-pedido.component.scss']
})
export class ListaPedidoComponent implements OnInit {

  bsModalRef: BsModalRef;
  @Input() titulo: string;
  @ViewChild(BuscaPedidoComponent, { static: false }) busca: BuscaPedidoComponent;
  qtdRegistros = 0;
  pedidos = [];
  loading = false;
  sortOrder = 1;
  sortIcon = faChevronUp;
  faChevronUp = faChevronUp;
  faChevronDown = faChevronDown;
  faPlus = faPlus;
  faPen = faPen;
  faTrashAlt = faTrashAlt;

  constructor(
    private modalService: BsModalService,
    private pedidoService: PedidoService
  ) {
    this.qtdRegistros = this.pedidos.length;
  }

  ngOnInit() {
    this.setSortOrder(this.sortOrder);
  }

  buscarPedidos(event: any) {
    this.pedidos = event.data;
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

    const titulo = acao === 'i' ? 'Incluir Pedido' : `Editar Pedido ${conteudo.id}`;

    const initialState = {
      tituloModal: `${titulo}`,
      conteudoModal: conteudo
    };

    this.bsModalRef = this.modalService.show(ModalPedidoComponent, {
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
      conteudoModal: `Você está prestes a apagar o pedido ${obj.id}! Tem certeza que deseja apagar?`
    };

    this.bsModalRef = this.modalService.show(ModalApagarComponent, {
      initialState,
      class: 'gray modal-lg'
    });

    this.bsModalRef.content.action.subscribe((value) => {
      if (value) {
        this.pedidoService.apagar(obj).subscribe((res) => {
          this.busca.buscar({});
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
    UtilProvider.ordenar(this.pedidos, prop, sortOrder);
  }

}
