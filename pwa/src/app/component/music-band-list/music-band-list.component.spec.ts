import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MusicBandListComponent } from './music-band-list.component';

describe('MusicBandListComponent', () => {
  let component: MusicBandListComponent;
  let fixture: ComponentFixture<MusicBandListComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [MusicBandListComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(MusicBandListComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
