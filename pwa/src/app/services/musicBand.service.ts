import { Observable } from 'rxjs';
import { Injectable } from '@angular/core';
import { MusicBand } from '../interface/musicBand.interface';
import { environment } from '../../environment';
import { HttpClient } from '@angular/common/http';

@Injectable({
    providedIn: 'root'
})
export class MusicBandService {
    private apiUrl: string = environment.apiUrl;
    constructor(private http: HttpClient) { }

    getMusicBands(): Observable<MusicBand[]> {
        return this.http.get<MusicBand[]>(`${this.apiUrl}/music_bands`);
    }

    createMusicBand(musicBand: MusicBand): Observable<MusicBand[]> {
        console.log(musicBand);
        const result = this.http.post<MusicBand[]>(`${this.apiUrl}/music_bands`, musicBand);
        result.subscribe({
            error: (err) => {
                console.log(err);
                alert("Une erreur est survenue");
            }
        });

        return result;
    }

    uploadMusicBands(file: File): void {
        const formData = new FormData();
        formData.append('import', file, file.name);

        const upload = this.http.post(`${this.apiUrl}/music_bands/upload`, formData);
        upload.subscribe({
            next: () => {
                alert("Les groupes ont été importés.");
            },
            error: () => {
                alert("Impossible d'importer les groupes.");
            }
        });
    }
}