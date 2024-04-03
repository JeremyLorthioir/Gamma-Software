import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { MusicBand } from '../../interface/musicBand.interface';
import { CommonModule } from '@angular/common';
import { MusicBandService } from '../../services/musicBand.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-add-music-band-form',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './add-music-band-form.component.html'
})
export class AddMusicBandFormComponent {
  musicBandForm: FormGroup;

  constructor(private formBuilder: FormBuilder, private router: Router, private musicBandService: MusicBandService) { }

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
      style: [''],
      description: ['', Validators.required]
    });
  }

  onSubmit() {
    if (this.musicBandForm.valid) {
      this.musicBandService.createMusicBand(this.musicBandForm.value).subscribe({
        next: () => {
          this.router.navigate(['/']);
        },
        error: () => {
          alert("Impossible de créer le groupe.");
        }
      });
    }
  }
}
