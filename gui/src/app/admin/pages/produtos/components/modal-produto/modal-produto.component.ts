import { Component, OnInit, ViewChild, Output, EventEmitter } from '@angular/core';
import { BsModalRef } from 'ngx-bootstrap/modal';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ProdutoService } from 'src/app/shared/services/produto.service';
import { faSave } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-modal-produto',
  templateUrl: './modal-produto.component.html',
  styleUrls: ['./modal-produto.component.scss']
})
export class ModalProdutoComponent implements OnInit {

  @Output() action = new EventEmitter();
  tituloModal: string;
  conteudoModal: any;
  faSave = faSave;
  produtoForm: FormGroup;
  enviado = false;

  constructor(
    public bsModalRef: BsModalRef,
    private fb: FormBuilder,
    private produtoService: ProdutoService
  ) {
    this.produtoForm = this.fb.group({
      id : [''],
      descricao : ['', Validators.required],
      quantidade : ['', Validators.required],
      preco : ['', Validators.required]
     });
  }

  get f() { return this.produtoForm.controls; }

  ngOnInit() {
    if (this.conteudoModal !== null) {
      this.produtoForm.patchValue(this.conteudoModal);
    }
  }

  salvar() {

    this.enviado = true;

    // stop here if form is invalid
    if (this.produtoForm.invalid) {
        return;
    }

    const produto = this.produtoForm.value;
    console.log(produto);
    this.produtoService.salvar(produto).subscribe((res) => {
      this.bsModalRef.hide();
      this.action.emit(true);
    });
  }

}
