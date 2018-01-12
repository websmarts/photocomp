<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{

    private $allowedMethods = ['paypal', 'direct_debit'];

    public function index()
    {
        //return view('checkout.index');
        return $this->using('paypal');
    }

    public function using($method)
    {
        $this->checkPaymentMethod($method);

        Auth::user()->application->payment_method = $method;
        Auth::user()->application->save();

        return redirect()->route('checkout.final', ['method' => $method]);
    }

    function final ($method) {
        $this->checkPaymentMethod($method);

        $application = Auth::user()->application;

        return view('checkout.' . $method, compact('application'));
    }

    private function checkPaymentMethod($method)
    {
        if (!in_array($method, $this->allowedMethods)) {
            abort(404);
        }
    }
}
