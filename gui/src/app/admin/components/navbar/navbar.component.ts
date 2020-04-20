import { AcessoService } from 'src/app/shared/services/acesso.service';
import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss']
})
export class NavbarComponent implements OnInit {

  constructor(private acessoService: AcessoService, private router: Router) { }

  ngOnInit() {
  }

  sair() {
    this.acessoService.logout();
    this.router.navigate(['/login']);
  }
}
