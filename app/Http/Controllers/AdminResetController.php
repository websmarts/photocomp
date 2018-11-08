<?php

namespace App\Http\Controllers;

use App\Utility\Utils;
use Illuminate\Support\Facades\DB;

class AdminResetController extends Controller
{
    public function reset()
    {
        
        // Check this is the admin user
        if(! auth()->user()->id == 1){
            flash('Bad request');
            back();
        }
        
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
