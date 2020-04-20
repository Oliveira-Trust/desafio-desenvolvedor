import { environment } from '../../../environments/environment';
import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders, HttpParams } from '@angular/common/http';
import { map } from 'rxjs/operators';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class StatusService {

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

  buscar(status: any): Observable<any> {

    const dados = this.tratarDados(status);

    return this.httpClient
      .get(`${this.url}/statuses${dados}`)
      .pipe(map((res: any) => res));
  }

  salvar(status: any) {
    if (status.id === '') {
      return this.httpClient
      .post(`${this.url}/statuses`, status)
      .pipe(map((res: any) => res));
    } else {
      return this.httpClient
      .put(`${this.url}/statuses/${status.id}`, status)
      .pipe(map((res: any) => res));
    }
  }

  apagar(status: any) {
    return this.httpClient
      .delete(`${this.url}/statuses/${status.id}`)
      .pipe(map((res: any) => res));
  }
}
