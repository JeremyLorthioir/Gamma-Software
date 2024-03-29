import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { MusicBand } from '../../interface/musicBand.interface';
import { CommonModule } from '@angular/common';
import { MusicBandService } from '../../services/musicBand.service';

@Component({
  selector: 'app-music-band-form',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './music-band-form.component.html'
})
export class MusicBandFormComponent {
  musicBandForm: FormGroup;

  constructor(private formBuilder: FormBuilder, private musicBandService: MusicBandService) { }

  ngOnInit(): void {
    this.initForm();
  }

  private initForm(): void {
    this.musicBandForm = this.formBuilder.group({
      name: ['', Validators.required],
      origin: ['', Validators.required],
      city: ['', Validators.required],
      foundationYear: [null, [Validators.required, Validators.pattern('\\d{4}')]],
      separationYear: [null],
      founders: ['', Validators.required],
      totalMembers: [null, [Validators.required, Validators.pattern('\\d+')]],
      style: ['', Validators.required],
      description: ['', Validators.required]
    });
  }

  onSubmit() {
    if (this.musicBandForm.valid) {
      this.musicBandService.createMusicBand(this.musicBandForm.value);
    }
  }
}
