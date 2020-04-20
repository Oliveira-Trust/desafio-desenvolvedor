import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaClientesComponent } from './lista-clientes.component';

describe('ListaClientesComponent', () => {
  let component: ListaClientesComponent;
  let fixture: ComponentFixture<ListaClientesComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListaClientesComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListaClientesComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
