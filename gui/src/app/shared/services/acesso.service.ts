import { environment } from '../../../environments/environment';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AcessoService {

  url = environment.baseUrl;

  constructor(private httpClient: HttpClient) {}

  public usuario: any;

  login(usuario) {
    return this.httpClient
      .post(`${this.url}/login`, usuario)
      .pipe(map((res: any) => {
        console.log(res);
        if (!res.message) {
          localStorage.setItem('usuario', res);
          this.usuario = res;
        }
      }));
  }

  logout() {
    localStorage.removeItem('usuario');
  }

}
