import { TestBed } from '@angular/core/testing';

import { PedidoService } from './pedido.service';

describe('PedidoService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: PedidoService = TestBed.get(PedidoService);
    expect(service).toBeTruthy();
  });
});
