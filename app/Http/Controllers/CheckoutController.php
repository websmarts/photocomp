<?php

namespace App\Http\Controllers;

class CheckoutController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:enter');
    }

    public function index()
    {
        return view('checkout.index');
    }
}
