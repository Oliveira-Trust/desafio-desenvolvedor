import { TestBed } from '@angular/core/testing';

import { AuthGuardChildService } from './auth-guard-child.service';

describe('AuthGuardChildService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: AuthGuardChildService = TestBed.get(AuthGuardChildService);
    expect(service).toBeTruthy();
  });
});
