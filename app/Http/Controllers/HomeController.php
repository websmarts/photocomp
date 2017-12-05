<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

    public function index()
    {
        $application = auth()->user()->application;

        return view('home', compact('application'));
    }

}
