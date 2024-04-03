import { Component } from '@angular/core';
import { FormBuilder, FormGroup, Validators, ReactiveFormsModule } from '@angular/forms';
import { MusicBand } from '../../interface/musicBand.interface';
import { CommonModule } from '@angular/common';
import { MusicBandService } from '../../services/musicBand.service';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-edit-music-band-form',
  standalone: true,
  imports: [CommonModule, ReactiveFormsModule],
  templateUrl: './edit-music-band-form.component.html'
})
export class EditMusicBandFormComponent {
  musicBandForm: FormGroup;
  musicBandData: MusicBand;

  constructor(private formBuilder: FormBuilder, private route: ActivatedRoute, private router: Router, private musicBandService: MusicBandService) { }

  ngOnInit(): void {
    const id = parseInt(this.route.snapshot.paramMap.get("id") || '');
    if (id != 0) {
      this.initForm();
      this.musicBandService.getMusicBandById(id).subscribe({
        next: (data) => {
          this.musicBandData = data;
          this.musicBandForm.patchValue(this.musicBandData);
        },
        error: () => {
          this.router.navigate(['/not-found']);
        }
      });
    }
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
      this.musicBandService.updateMusicBand(this.musicBandData.id, this.musicBandForm.value).subscribe({
        next: () => {
          this.router.navigate(['/']);
        },
        error: () => {
          alert("Impossible de modifier le groupe.");
        }
      });
    }
  }
}
