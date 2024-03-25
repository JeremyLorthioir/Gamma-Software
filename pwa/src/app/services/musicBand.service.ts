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
}