import { Component } from '@angular/core';
import { MusicBand } from '../../interface/musicBand.interface';
import { MusicBandService } from '../../services/musicBand.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-music-band-list',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './music-band-list.component.html'
})
export class MusicBandListComponent {

  musicBands: MusicBand[] = [];

  constructor(private MusicBandService: MusicBandService) { }

  ngOnInit(): void {
    this.MusicBandService.getMusicBands().subscribe((musicBands) => { this.musicBands = musicBands });
  }

  deleteMusicBand(musicBand: MusicBand): void {
    this.MusicBandService.deleteMusicBand(musicBand.id).subscribe({
      next: () => {
        this.ngOnInit();
      }
    });
  }

  updateMusicBand(musicBand: MusicBand): void {
    // this.MusicBandService.deleteMusicBand(id);
  }
}
