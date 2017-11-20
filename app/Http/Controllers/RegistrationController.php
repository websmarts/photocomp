<?php

namespace App\Http\Controllers;

use App\Application;
use App\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        // Mark the user registration form as incomplete
        $user = auth()->user();
        if (!$user->application) {
            $application = new Application;
            $user->application()->save($application);
        }

        // Set registration_status to invalid just in case it fails validation
        $user->application->registration_status = false;
        $user->application->save();

        // Validate the Registration form submission
        $this->validator($request->all())->validate();

        // Request is valid so registration_status is true
        $user->application->registration_status = true;
        $user->application->save();

        // Update the users application data
        $user->application->update($request->all());
        flash('Your registration details have been updated successfully');

        //dd('going home');
        return redirect()->route('home');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'salutation' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'honours' => 'required|string|max:255',
            'address1' => 'required|string|max:255',
            //'address2' => 'required|string|nullable|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'vaps_affiliated' => 'required|string|max:255',
            'aps_member' => 'required|string|max:255',
            'club_nomination' => 'required|string|max:255',
            'confirm_terms' => 'required',
        ]);
    }
}
