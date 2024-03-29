import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MusicBandFormComponent } from './music-band-form.component';

describe('MusicBandFormComponent', () => {
  let component: MusicBandFormComponent;
  let fixture: ComponentFixture<MusicBandFormComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [MusicBandFormComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(MusicBandFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
