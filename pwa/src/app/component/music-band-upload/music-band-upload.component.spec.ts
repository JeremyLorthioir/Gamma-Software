import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MusicBandUploadComponent } from './music-band-upload.component';

describe('MusicBandUploadComponent', () => {
  let component: MusicBandUploadComponent;
  let fixture: ComponentFixture<MusicBandUploadComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [MusicBandUploadComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(MusicBandUploadComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
