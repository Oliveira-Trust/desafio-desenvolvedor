import { Component, OnInit, AfterViewInit, ViewChild, Output, EventEmitter, ElementRef, ɵCodegenComponentFactoryResolver } from '@angular/core';
import { BsModalRef } from 'ngx-bootstrap/modal';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ClienteService } from 'src/app/shared/services/cliente.service';
import { ProdutoService } from 'src/app/shared/services/produto.service';
import { PedidoService } from 'src/app/shared/services/pedido.service';
import { faSave, faPlus, faTimes } from '@fortawesome/free-solid-svg-icons';
import { StatusService } from 'src/app/shared/services/status.service';

@Component({
  selector: 'app-modal-pedido',
  templateUrl: './modal-pedido.component.html',
  styleUrls: ['./modal-pedido.component.scss']
})
export class ModalPedidoComponent implements OnInit, AfterViewInit {

  @Output() action = new EventEmitter();
  @ViewChild('slcClientes', { static: false }) slcClientes;
  @ViewChild('slcProdutos', { static: false }) slcProdutos;
  @ViewChild('inQuantidade', { static: false }) inQuantidade;
  @ViewChild('btnEnviar', { static: false }) btnEnviar;
  faSave = faSave;
  faPlus = faPlus;
  faTimes = faTimes;
  tituloModal: string;
  conteudoModal: any;
  clientes: any;
  produtos: any;
  statuses: any;
  pedidoForm: FormGroup;
  enviado = false;
  cliente: any;
  total = 0;
  itens = [];

  constructor(
    public bsModalRef: BsModalRef,
    private fb: FormBuilder,
    private clienteService: ClienteService,
    private produtoService: ProdutoService,
    private statusService: StatusService,
    private pedidoService: PedidoService
  ) {
    this.pedidoForm = this.fb.group({
      id : [''],
      cliente_id : [ '', Validators.required],
      status_id: [ 1, Validators.required],
      itens : [ [] , Validators.required],
      total : [0, Validators.required]
     });
  }

  get f() { return this.pedidoForm.controls; }

  ngOnInit() {

    this.clienteService
      .buscar({})
      .subscribe((res) => {
      this.clientes = res.data;
    });

    this.produtoService
      .buscar({})
      .subscribe((res) => {
      this.produtos = res.data;
    });

    this.statusService
      .buscar({})
      .subscribe((res) => {
      this.statuses = res.data;
    });

  }

  ngAfterViewInit() {
    if (this.conteudoModal !== null) {
      this.cliente = this.conteudoModal.cliente;
      this.total = parseFloat(this.conteudoModal.total);
      this.itens = this.conteudoModal.itens.map(item => {
        return {
          produto_id: item.produto_id,
          descricao: item.produto.descricao,
          preco: item.preco,
          quantidade: item.quantidade
        };
      });

      this.pedidoForm.patchValue({
        id: this.conteudoModal.id,
        status_id: this.conteudoModal.status_id
      });
    }
  }

  adicionar() {

    if (this.slcClientes.nativeElement.value !== '' &&
        this.slcProdutos.nativeElement.value !== '' &&
        this.inQuantidade.nativeElement.value !== '') {

      if (!this.cliente) {
        this.slcClientes.nativeElement.disabled = true;
        this.cliente = this.clientes.find(x => x.id === parseInt(this.slcClientes.nativeElement.value, 10));
      }

      const produto = this.produtos.find(x => x.id === parseInt(this.slcProdutos.nativeElement.value, 10));
      const quantidade = parseInt(this.inQuantidade.nativeElement.value, 10);
      const item = { produto_id: produto.id, descricao: produto.descricao, preco: produto.preco * quantidade, quantidade };
      this.total += item.preco;
      this.itens.push(item);

    }

  }

  remover(i) {

    if (this.total > 0) {
      this.total -= this.itens[i].preco;
    }

    this.itens.splice(i, 1);

    if (this.itens.length === 0) {
      this.cliente = null;
      this.slcProdutos.nativeElement.disabled = false;
    }
  }

  salvar() {

    this.enviado = true;

    this.btnEnviar.nativeElement.disabled = true;

    this.pedidoForm.patchValue({
      cliente_id: this.cliente.id,
      itens: this.itens,
      total: this.total
    });

    // stop here if form is invalid
    if (this.pedidoForm.invalid) {
        return;
    }

    this.pedidoService.salvar(this.pedidoForm.value).subscribe((res) => {
      this.bsModalRef.hide();
      this.action.emit(true);
    });
  }

}
