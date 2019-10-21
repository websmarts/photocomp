<?php

namespace App\Http\Controllers;



use App\User;

use App\Category;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    
    protected $user;
    protected $categories;
    
    public function index($user)
    {
        
        dd('unsupported request');// This controller is not used in production!!!

        $user = User::find($user);
        if(!$user ) {
            flash('unable to complete request');
            return redirect('home');
        }
       

        // Get list of user PRINTS ie User Photos where category_id =2

        $prints = $user->prints()->with('section')->get();

        

       // dd($user->prints->count());
       
       

        // return view('entries.labels2',compact('user','prints'));

        $pdf = PDF::loadView('entries.labels2', compact('user','prints'));

        // Save pdf to storage
        Storage::disk('public')->put('labels/labels_' . $user->id.'.pdf',$pdf->output());


        return $pdf->stream('labels.pdf');
    }
}
