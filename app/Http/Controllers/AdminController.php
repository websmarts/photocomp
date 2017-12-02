<?php

namespace App\Http\Controllers;

use App\Application;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function applications()
    {
        $applications = Application::with('photos')->get();
        return view('admin.applications')->with('applications', $applications);
    }

}
