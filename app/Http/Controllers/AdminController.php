<?php

namespace App\Http\Controllers;

use App\Application;
use App\Photo;
use App\Utility\Utils;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $applicationCount = Application::where('id', '>', 0)->count();
        $photoCount = Photo::where('id', '>', 0)->count();

        return view('admin.index', compact('applicationCount', 'photoCount'));
    }

    public function reset()
    {
        // Check the compitition is closed - it needs to be
        if (strtolower($this->setting('competition_status')) !== 'closed') {
            flash('Cannot reset the application unless the competition status is "closed"');
            back();
        }

        // remove all photos and Images
        DB::delete('delete from photos');
        Utils::trashOrphanPhotos();

        // remove all Users - except admin
        DB::delete('delete from users where id > 1');

        // remove all Applications
        DB::delete('delete from applications');

        flash('Application reset completed');
        return back();
    }

}
