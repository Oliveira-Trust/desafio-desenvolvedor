import { Component, OnInit } from '@angular/core';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { AcessoService } from 'src/app/shared/services/acesso.service';
import { faUser, faLock, faSignInAlt } from '@fortawesome/free-solid-svg-icons';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  faUser = faUser;
  faLock = faLock;
  faSignInAlt = faSignInAlt;
  loginForm: FormGroup;
  token: any;

  constructor(private fb: FormBuilder, private acessoService: AcessoService, private router: Router) {
  }

  ngOnInit() {
    this.loginForm = this.fb.group({
      email : [''],
      password : ['']
     });
  }

  login() {
    this.acessoService.login(this.loginForm.value)
      .subscribe((res) => {
      this.router.navigate(['admin']);
    });
  }

}
