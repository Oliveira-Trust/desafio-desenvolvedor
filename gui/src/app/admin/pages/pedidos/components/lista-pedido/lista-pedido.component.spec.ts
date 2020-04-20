import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ListaPedidoComponent } from './lista-pedido.component';

describe('ListaPedidoComponent', () => {
  let component: ListaPedidoComponent;
  let fixture: ComponentFixture<ListaPedidoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ListaPedidoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ListaPedidoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
