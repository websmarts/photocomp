<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings_form');
    }

    public function update(Request $request)
    {
        $settings = Setting::first();

        

        $validatedData = $request->validate([
            'title' => 'required',
            'first_section_cost' => 'nullable',
            'max_entries_per_section' => 'required|integer|min:1|max:10',
            'terms_and_conditions_url' => 'required',
            'competition_status' => 'required',
            'return_instructions' => 'required',
            'paypal_mode' => 'required',
            'flagfall_cost' => 'required|numeric|min:0',
            'digital_section_cost' => 'required|numeric|min:0',
            'print_section_cost' => 'required|numeric|min:0'
    
        ]);

        //dd($validatedData);

        //$data = $request->except(['save_btn', '_token']);

        $settings->update($validatedData);

        return back();
    }

}
