import { Routes } from '@angular/router';
import { MusicBandListComponent } from './music-band-list/music-band-list.component';
import { MusicBandUploadComponent } from './music-band-upload/music-band-upload.component';
import { MusicBandFormComponent } from './music-band-form/music-band-form.component';

export const routes: Routes = [
    { path: '', component: MusicBandListComponent },
    { path: 'music-bands-upload', component: MusicBandUploadComponent },
    { path: 'music-bands-create', component: MusicBandFormComponent },
];
