<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Carbon;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
}
