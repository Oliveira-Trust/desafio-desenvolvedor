import { Injectable } from '@angular/core';
import { HttpInterceptor, HttpRequest, HttpHandler, HttpEvent } from '@angular/common/http';
import { AcessoService } from 'src/app/shared/services/acesso.service';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AdminInterceptorService implements HttpInterceptor {

  constructor(private acessoService: AcessoService) { }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    // add authorization header with jwt token if available
    const usuarioAtual = this.acessoService.usuario;
    if (usuarioAtual && usuarioAtual.token) {
        request = request.clone({
            setHeaders: {
                Authorization: `Bearer ${usuarioAtual.token}`
            }
        });
    }

    return next.handle(request);
}
}
