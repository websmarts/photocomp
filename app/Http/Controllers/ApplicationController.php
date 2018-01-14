<?php

namespace App\Http\Controllers;

use App\Application;
use App\Club;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{

    /**
     * Show the Registration Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $options = [
            'salutations' => ['Mr', 'Mrs', 'Ms', 'Miss', 'Dr'],
            'yesno' => ['Yes', 'No'],
            'vapsclubs' => Club::all()->pluck('name', 'id'),
            'states' => ['ACT', 'NSW', 'NT', 'QLD', 'SA', 'TAS', 'VIC', 'WA'],

        ];

        $application = auth()->user()->application;

        return view('registration.index', compact('options', 'application'));
    }

    public function processRegistrationForm(Request $request)
    {
        $attributes = $request->validate([
            'salutation' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'honours' => 'nullable|string|max:255',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|nullable|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|integer|digits:4',
            'state' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'vaps_affiliated' => 'required|string|max:255',
            'aps_member' => 'required|string|max:255',
            'club_nomination' => 'nullable|string|max:255',
            'confirm_terms' => 'required',
        ]);

        $application = Application::firstOrCreate(['user_id' => $request->user()->id]);

        $application->update($attributes);

        flash('Your registration details have been updated successfully');

        return redirect()->route('home');
    }

}
