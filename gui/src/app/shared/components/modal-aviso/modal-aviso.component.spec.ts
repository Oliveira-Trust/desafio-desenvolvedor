import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ModalAvisoComponent } from './modal-aviso.component';

describe('ModalAvisoComponent', () => {
  let component: ModalAvisoComponent;
  let fixture: ComponentFixture<ModalAvisoComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ModalAvisoComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ModalAvisoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
