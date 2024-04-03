import { Routes } from '@angular/router';
import { MusicBandListComponent } from './music-band-list/music-band-list.component';
import { MusicBandUploadComponent } from './music-band-upload/music-band-upload.component';
import { AddMusicBandFormComponent } from './add-music-band-form/add-music-band-form.component';
import { EditMusicBandFormComponent } from './edit-music-band-form/edit-music-band-form.component';
import { PageNotFoundComponent } from './page-not-found/page-not-found.component';

export const routes: Routes = [
    { path: '', component: MusicBandListComponent },
    { path: 'music-bands-upload', component: MusicBandUploadComponent },
    { path: 'music-bands-create', component: AddMusicBandFormComponent },
    { path: 'music-bands-edit/:id', component: EditMusicBandFormComponent },
    { path: '**', component: PageNotFoundComponent }
];
