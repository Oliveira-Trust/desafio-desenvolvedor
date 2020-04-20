import { environment } from '../../../environments/environment';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class PedidoService {

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

  buscar(pedido: any): Observable<any> {

    const dados = this.tratarDados(pedido);

    return this.httpClient
      .get(`${this.url}/pedidos${dados}`)
      .pipe(map((res: any) => res));
  }

  salvar(pedido: any) {
    if (pedido.id === '') {
      return this.httpClient
      .post(`${this.url}/pedidos`, pedido)
      .pipe(map((res: any) => res));
    } else {
      return this.httpClient
      .put(`${this.url}/pedidos/${pedido.id}`, pedido)
      .pipe(map((res: any) => res));
    }
  }

  apagar(pedido: any) {
    return this.httpClient
      .delete(`${this.url}/pedidos/${pedido.id}`)
      .pipe(map((res: any) => res));
  }
}
