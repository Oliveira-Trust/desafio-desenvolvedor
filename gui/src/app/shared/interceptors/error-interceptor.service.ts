import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { catchError } from 'rxjs/operators';
import { AcessoService } from '../services/acesso.service';



@Injectable()
export class ErrorInterceptor implements HttpInterceptor {
    constructor(private acessoService: AcessoService) { }

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        return next.handle(request).pipe(catchError(err => {
            if (err.status === 401) {
                // auto logout if 401 response returned from api
                this.acessoService.logout();
                location.reload(true);
            }

            const error = err.error.message || err.statusText;
            
            return throwError(error);
        }))
    }
}