import { Component } from '@angular/core';
import { MusicBandService } from '../../services/musicBand.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-music-band-upload',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './music-band-upload.component.html'
})
export class MusicBandUploadComponent {
  file: File | null = null;

  constructor(private MusicBandService: MusicBandService) { }

  ngOnInit(): void { }

  onChange(event: any) {
    const file: File = event.target.files[0];

    if (file) {
      this.file = file;
    }
  }

  onUpload() {
    if (this.file) {
      this.MusicBandService.uploadMusicBands(this.file);
    }
  }
}
