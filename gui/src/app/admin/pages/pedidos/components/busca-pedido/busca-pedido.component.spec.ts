import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { BuscaPedidoComponent } from './busca-pedido.component';

describe('BuscaPedidoComponent', () => {
  let component: BuscaPedidoComponent;
  let fixture: ComponentFixture<BuscaPedidoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ BuscaPedidoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(BuscaPedidoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
