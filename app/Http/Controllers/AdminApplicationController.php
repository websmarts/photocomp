<?php

namespace App\Http\Controllers;

use App\Application;
use App\Photo;
use App\Utility\PhotosHandler;
use Illuminate\Http\Request;

class AdminApplicationController extends Controller
{

    public function index()
    {
        $applications = Application::with('photos')->get();
        return view('admin.applications')->with('applications', $applications);
    }

    public function edit(Application $application)
    {
        // dd($application);
        return view('admin.edit_application_form', compact('application'));
    }

    public function update(Application $application, Request $request)
    {
        if ($request->input('delete_application') == 'DELETE') {
            return $this->delete($application);
        }

        $application->mc_gross = $request->mc_gross;
        $application->payment_method = $request->payment_method;
        $application->notes = $request->notes;
        $application->save();

        flash('Success - application updated');
        return redirect()->route('admin.application.edit', ['application' => $application->id]);

    }

    private function delete($application)
    {
        // delete Photos
        $photos = Photo::where('user_id', $application->user_id)->get();
        if ($photos) {
            $photosHandler = new PhotosHandler($this->setting(), $application->user);
            foreach ($photos as $photo) {
                $photosHandler->delete($photo->id);
            }
        }

        // Delete Application user and application
        $application->user->delete();
        $application->delete();

        flash('Success - application deleted');
        return redirect()->route('admin.applications');

    }

    public function verifyEmail(Application $application)
    {
        $application->user->confirmEmail();

        flash('Success - application has been updated');
        return redirect()->route('admin.application.edit', ['application' => $application->id]);

    }
}
