import { Component, OnInit, Output, EventEmitter } from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';

@Component({
  selector: 'app-modal-apagar',
  templateUrl: './modal-apagar.component.html',
  styleUrls: ['./modal-apagar.component.scss']
})
export class ModalApagarComponent implements OnInit {

  // modalRef: BsModalRef;
  tituloModal: string;
  conteudoModal: string;
  @Output() action = new EventEmitter();

  constructor(private modalService: BsModalService, private modalRef: BsModalRef) { }

  ngOnInit() {
  }

  confirm() {
    this.modalRef.hide();
    this.action.emit(true);
  }

  decline() {
    this.modalRef.hide();
    this.action.emit(false);
  }

}
