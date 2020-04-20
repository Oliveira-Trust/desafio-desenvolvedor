import { AcessoService } from 'src/app/shared/services/acesso.service';
import { Injectable } from '@angular/core';
import { CanActivateChild, ActivatedRouteSnapshot, RouterStateSnapshot, Router } from '@angular/router';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthGuardChildService implements CanActivateChild {

  private isAuthenticated: boolean = false;

  // private authenticationService: AuthenticationService

  constructor(private router: Router, private acessoService: AcessoService) {}

  canActivateChild(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean> | boolean {
    this.isAuthenticated = this.acessoService.usuario && this.acessoService.usuario.token ? true : false;

    if (!this.isAuthenticated) {
      this.router.navigate(['/login']);
    }

    return this.isAuthenticated;
  }
}
