import { environment } from '../../../environments/environment';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ProdutoService {

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

  buscar(produto: any): Observable<any> {

    const dados = this.tratarDados(produto);

    return this.httpClient
      .get(`${this.url}/produtos${dados}`)
      .pipe(map((res: any) => res));
  }

  salvar(produto: any) {
    if (produto.id === '') {
      return this.httpClient
      .post(`${this.url}/produtos`, produto)
      .pipe(map((res: any) => res));
    } else {
      return this.httpClient
      .put(`${this.url}/produtos/${produto.id}`, produto)
      .pipe(map((res: any) => res));
    }
  }

  apagar(produto: any) {
    return this.httpClient
      .delete(`${this.url}/produtos/${produto.id}`)
      .pipe(map((res: any) => res));
  }
}
