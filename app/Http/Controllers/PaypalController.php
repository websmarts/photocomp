<?php

namespace App\Http\Controllers;

use Fahim\PaypalIPN\PaypalIPNListener;
use Illuminate\Http\Request;

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

        // Log::info("-----new payment-----");

        Log::info($report);

        if ($verified) {

            $data['mc_gross'] = $request->mc_gross;
            $data['mc_gross_1'] = $request->mc_gross_1;
            $data['mc_gross_2'] = $request->mc_gross_2;
            $data['mc_fee'] = $request->mc_fee;
            $data['txn_id'] = $request->txn_id;
            $data['payment_date'] = $request->payment_date;

            $userId = (int) $request->custom;

            // Check if txn_id has already been processed
            $txn = Application::where('txn_id', $data['txn_id'])->first();

            if (!$txn && $userId > 0) {
                Application::where('user_id', $userId)->update($data);
            }

        } else {
            // Log::info("Some thing went wrong in the payment !");
        }
    }

}
