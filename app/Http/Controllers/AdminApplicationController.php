<?php

namespace App\Http\Controllers;

use App\Application;
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
        $application->mc_gross = $request->mc_gross;
        $application->payment_method = $request->payment_method;
        $application->notes = $request->notes;
        $application->save();

        flash('Success - application updated');
        return redirect()->route('admin.application.edit', ['application' => $application->id]);

    }
}
