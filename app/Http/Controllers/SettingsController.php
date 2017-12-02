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

        $data = $request->except(['save_btn', '_token']);

        $settings->update($request->all());

        return back();
    }

}
