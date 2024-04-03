import { ComponentFixture, TestBed } from '@angular/core/testing';

import { EditMusicBandFormComponent } from './edit-music-band-form.component';

describe('AddMusicBandFormComponent', () => {
  let component: EditMusicBandFormComponent;
  let fixture: ComponentFixture<EditMusicBandFormComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [EditMusicBandFormComponent]
    })
      .compileComponents();

    fixture = TestBed.createComponent(EditMusicBandFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
