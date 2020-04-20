import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BuscaClienteComponent } from './busca-cliente.component';

describe('BuscaClienteComponent', () => {
  let component: BuscaClienteComponent;
  let fixture: ComponentFixture<BuscaClienteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BuscaClienteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BuscaClienteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
