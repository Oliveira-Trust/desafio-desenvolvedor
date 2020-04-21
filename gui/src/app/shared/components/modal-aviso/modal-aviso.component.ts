import { Component, OnInit } from '@angular/core';
import { BsModalService, BsModalRef } from 'ngx-bootstrap/modal';

@Component({
  selector: 'app-modal-aviso',
  templateUrl: './modal-aviso.component.html',
  styleUrls: ['./modal-aviso.component.scss']
})
export class ModalAvisoComponent implements OnInit {

  // modalRef: BsModalRef;
  tituloModal: string;
  conteudoModal: string;

  constructor(private modalService: BsModalService, private modalRef: BsModalRef) { }

  ngOnInit() {
  }

}
