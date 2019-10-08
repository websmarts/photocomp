<?php

namespace App\Http\Controllers;



use App\User;

use App\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;

class PdfController extends Controller
{
    
    protected $user;
    protected $categories;
    
    public function index($user)
    {
        $user = User::find($user);
        if(!$user ) {
            flash('unable to complete request');
            return redirect('home');
        }
       

        // Get list of user PRINTS ie User Photos where category_id =2

        $prints = $user->prints()->with('section')->get();

        

        
       
       

        // return view('entries.labels2',compact('user','prints'));

        $pdf = PDF::loadView('entries.labels2', compact('user','prints'));
        return $pdf->stream('labels.pdf');
    }
}
