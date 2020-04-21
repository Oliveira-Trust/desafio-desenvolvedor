import { AcessoService } from 'src/app/shared/services/acesso.service';
import { Injectable } from '@angular/core';
import { CanActivateChild, ActivatedRouteSnapshot, RouterStateSnapshot, Router } from '@angular/router';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AuthGuardChildService implements CanActivateChild {

  private isAuthenticated: boolean = false;

  constructor(private router: Router, private acessoService: AcessoService) {}

  canActivateChild(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean> | boolean {

    const userAuthenticated = this.acessoService.getLocalStorage();

    this.isAuthenticated = userAuthenticated && userAuthenticated.jwt.token ? true : false;

    if (!this.isAuthenticated) {
      this.acessoService.logout();
      this.router.navigate(['/login']);
    }

    return this.isAuthenticated;
  }
}
