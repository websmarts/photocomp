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

        // Create a Job to Handle these initial tasks
        $this->dispatch((new SetupForPhotoExport)->onQueue('high'));

        // Now dispach the phot export jobs
        $photos->map(function ($photo) {

            $this->dispatch((new ExportPhoto($photo))->onQueue('low'));
        });

        // Display a view that displays the number  of
        // photos NOT exported. ie via ajax query
        return view('admin.export_monitor');

    }
}
