import { TestBed } from '@angular/core/testing';

import { ProdutoService } from './produto.service';

describe('ProdutoService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: ProdutoService = TestBed.get(ProdutoService);
    expect(service).toBeTruthy();
  });
});
