import { environment } from '../../../environments/environment';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ClienteService {

  url = environment.baseUrl;

  constructor(private httpClient: HttpClient) {}

  tratarDados(dados: any) {
    let params = '';

    for (const prop in dados) {
      if (dados[prop] !== '') {
        params += `${prop}=${dados[prop]}&`;
      }
    }

    let urlParams = '';

    if (params !== '') {
      urlParams = `?${params.replace(/\&$/, '')}`;
    }

    return urlParams;
  }

  buscar(cliente: any): Observable<any> {

    const dados = this.tratarDados(cliente);

    return this.httpClient
      .get(`${this.url}/clientes${dados}`)
      .pipe(map((res: any) => res));
  }

  salvar(cliente: any) {
    if (cliente.id === '') {
      return this.httpClient
      .post(`${this.url}/clientes`, cliente)
      .pipe(map((res: any) => res));
    } else {
      return this.httpClient
      .put(`${this.url}/clientes/${cliente.id}`, cliente)
      .pipe(map((res: any) => res));
    }
  }

  apagar(cliente: any) {
    return this.httpClient
      .delete(`${this.url}/clientes/${cliente.id}`)
      .pipe(map((res: any) => res));
  }
}
