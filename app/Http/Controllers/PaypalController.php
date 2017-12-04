<?php

namespace App\Http\Controllers;

use Fahim\PaypalIPN\PaypalIPNListener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaypalController extends Controller
{
    public function success(Request $request)
    {

        $data = $request->all();
        return view('paypal.success', compact('data'));

    }

    public function cancel(Request $request)
    {

        $data = $request->all();
        return view('paypal.cancel', compact('data'));

    }

    public function ipn(Request $request)
    {
        $ipn = new PaypalIPNListener();
        $ipn->use_sandbox = true;

        $verified = $ipn->processIpn();

        $report = $ipn->getTextReport();

        Log::info("-----new payment-----");

        Log::info($report);

        if ($verified) {
            if ($request->input('address_status') == 'confirmed') {
                // Check outh POST variable and insert your logic here
                Log::info("payment verified and inserted to db");
            }
        } else {
            Log::info("Some thing went wrong in the payment !");
        }
    }

}
