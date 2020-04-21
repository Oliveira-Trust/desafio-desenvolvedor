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

  public getLocalStorage() : any {
    return JSON.parse(localStorage.getItem('usuario'));
  }

  setLocalStorage(item) {
    localStorage.setItem('usuario', JSON.stringify(item));
  }

  removeLocalStorage(id) {
    localStorage.removeItem(id);
  }

  login(usuario) {
    return this.httpClient
      .post(`${this.url}/login`, usuario)
      .pipe(map((res: any) => {
        this.setLocalStorage(res);
      }));
  }

  logout() {
    this.removeLocalStorage('usuario');
  }

}
