import { TestBed } from '@angular/core/testing';

import { AcessoService } from './acesso.service';

describe('AcessoService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: AcessoService = TestBed.get(AcessoService);
    expect(service).toBeTruthy();
  });
});
