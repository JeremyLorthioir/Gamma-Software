import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AddMusicBandFormComponent } from './add-music-band-form.component';

describe('AddMusicBandFormComponent', () => {
  let component: AddMusicBandFormComponent;
  let fixture: ComponentFixture<AddMusicBandFormComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [AddMusicBandFormComponent]
    })
      .compileComponents();

    fixture = TestBed.createComponent(AddMusicBandFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
