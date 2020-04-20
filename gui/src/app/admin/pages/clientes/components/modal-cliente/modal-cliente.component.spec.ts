import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalClienteComponent } from './modal-cliente.component';

describe('ModalClienteComponent', () => {
  let component: ModalClienteComponent;
  let fixture: ComponentFixture<ModalClienteComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalClienteComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalClienteComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
