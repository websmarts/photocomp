<?php

namespace App\Http\Controllers;

use App\Jobs\ExportPhoto;
use App\Jobs\SetupForPhotoExport;
use App\Photo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ExportPhotosController extends Controller
{
    public function export()
    {

        $photos = Photo::OrderBy('user_id', 'asc')
            ->orderBy('section_id', 'asc')
            ->orderBy('section_entry_number', 'asc')
            ->get(); // Always export ALL photos

    
        Storage::disk('local')->put('logs/export.log', 'Photo  export date: ' . Carbon::now()->toFormattedDateString());

        // Compile the list of photo export jobs
        $photoExports = $photos->map(function ($photo) {
            return new \App\Jobs\ExportPhoto($photo);
        });



        SetupForPhotoExport::withChain($photoExports->toArray())->dispatch()->allOnConnection('database')->allOnQueue('export');

        // Display a view that displays the number  of
        // photos NOT exported. ie via ajax query
        return view('admin.export_monitor');

    }
}
