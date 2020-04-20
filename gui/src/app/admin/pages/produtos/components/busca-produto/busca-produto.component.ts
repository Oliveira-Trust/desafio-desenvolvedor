import { Component, OnInit, Input, Output, EventEmitter } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { ProdutoService } from 'src/app/shared/services/produto.service';
import { faSearch } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-busca-produto',
  templateUrl: './busca-produto.component.html',
  styleUrls: ['./busca-produto.component.scss']
})
export class BuscaProdutoComponent implements OnInit {

  @Input() titulo: string;
  @Output() listarProdutos = new EventEmitter();
  produtoForm: FormGroup;
  faSearch = faSearch;

  constructor(private fb: FormBuilder, private produtoService: ProdutoService) {}

  ngOnInit() {
    this.produtoForm = this.fb.group({
     id : [''],
     descricao : [''],
     quantidade : [''],
     preco : [''],
    });

    this.buscar({});
  }

  buscar(produto: any) {
    this.produtoService
      .buscar(produto)
      .subscribe(res => {
        this.listarProdutos.emit(res);
    });
  }

}
