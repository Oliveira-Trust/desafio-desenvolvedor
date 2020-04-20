import { TestBed } from '@angular/core/testing';

import { AdminInterceptorService } from './admin-interceptor.service';

describe('AdminInterceptorService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: AdminInterceptorService = TestBed.get(AdminInterceptorService);
    expect(service).toBeTruthy();
  });
});
