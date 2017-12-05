<?php

namespace App\Http\Controllers;

use App\Application;
use App\Photo;

class AdminController extends Controller
{
    public function index()
    {
        $applicationCount = Application::where('id', '>', 0)->count();
        $photoCount = Photo::where('id', '>', 0)->count();

        return view('admin.index', compact('applicationCount', 'photoCount'));
    }

}
