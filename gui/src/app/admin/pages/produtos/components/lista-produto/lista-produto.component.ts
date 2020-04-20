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
import { ProdutoService } from 'src/app/shared/services/produto.service';
import { ModalApagarComponent } from 'src/app/shared/components/modal-apagar/modal-apagar.component';
import { ModalProdutoComponent } from './../modal-produto/modal-produto.component';
import { BuscaProdutoComponent } from './../busca-produto/busca-produto.component';

@Component({
  selector: 'app-lista-produto',
  templateUrl: './lista-produto.component.html',
  styleUrls: ['./lista-produto.component.scss']
})
export class ListaProdutoComponent implements OnInit {
  bsModalRef: BsModalRef;
  @Input() titulo: string;
  @ViewChild(BuscaProdutoComponent, { static: false }) busca: BuscaProdutoComponent;
  qtdRegistros = 0;
  produtos = [];
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
    private clienteService: ProdutoService
  ) {
    this.qtdRegistros = this.produtos.length;
  }

  ngOnInit() {
    this.setSortOrder(this.sortOrder);
  }

  buscarProdutos(event: any) {
    this.produtos = event.data;
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

    const titulo = acao === 'i' ? 'Incluir Produto' : `Editar Produto ${conteudo.nome}`;

    const initialState = {
      tituloModal: `${titulo}`,
      conteudoModal: conteudo
    };

    this.bsModalRef = this.modalService.show(ModalProdutoComponent, {
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
      conteudoModal: `Você está prestes a apagar o produto ${obj.descricao}! Tem certeza que deseja apagar?`
    };

    this.bsModalRef = this.modalService.show(ModalApagarComponent, {
      initialState,
      class: 'gray modal-lg'
    });

    this.bsModalRef.content.action.subscribe((value) => {
      if (value) {
        this.clienteService.apagar(obj).subscribe((res) => {
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
    UtilProvider.ordenar(this.produtos, prop, sortOrder);
  }

}
