import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class UtilProvider {

  constructor() {}

  static ordenar(lista, prop, sortOrder) {
    if (sortOrder === 0) {
      this.ordenarCrescente(lista, prop);
    } else if (sortOrder === 1) {
      this.ordenarDecrescente(lista, prop);
    }
  }

  static ordenarCrescente(lista, prop) {
    return lista.sort((a, b) => {
      if (a[prop] < b[prop]) {
        return -1;
      }
      if (a[prop] > b[prop]) {
        return 1;
      }
    });
  }

  static ordenarDecrescente(lista, prop) {
    return lista.sort((a, b) => {
      if (a[prop] < b[prop]) {
        return 1;
      }
      if (a[prop] > b[prop]) {
        return -1;
      }
    });
  }

  static ucFirst(texto: any) {
    return texto.charAt(0).toUpperCase() + texto.slice(1);
  }
}
