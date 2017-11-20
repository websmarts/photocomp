<?php

namespace App\Http\Controllers;

class ApplicationController extends Controller
{

    public function register()
    {

        $options = [
            'salutations' => ['Mr', 'Mrs', 'Ms', 'Miss', 'Dr'],
            'yesno' => ['Yes', 'No'],
            'vapsclubs' => Club::all()->pluck('name', 'id'),
            'states' => ['ACT', 'NSW', 'NT', 'QLD', 'SA', 'TAS', 'VIC', 'WA'],

        ];

        return view('home', compact('options'));
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
            'address2' => 'required|string|nullable|max:255',
            'city' => 'required|string|max:255',
            'postcode' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'vaps_affiliated' => 'required|string|max:255',
            'vaps_member' => 'required|string|max:255',
            'club_nomination' => 'required|string|max:255',
        ]);
    }

    /**
     * Display a page telling the newly registered user
     * that they need to verify their email address
     *
     * @method registered
     * @return [type]     [View]
     */
    public function registered()
    {
        return view('registered');
    }
}
