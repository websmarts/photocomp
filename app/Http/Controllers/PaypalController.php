<?php

namespace App\Http\Controllers;

use App\Application;
use App\Mail\ApplicationReport;
use App\Setting;
use App\User;
use Fahim\PaypalIPN\PaypalIPNListener;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        // Live or Sandbox mode?
        $paypalMode = Setting::first()->paypal_mode;
        $ipn->use_sandbox = $paypalMode == 'Sandbox';

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

                $user = User::find($userId);

                // Send Email with Application confirmation to user and cc admin
                $admin = User::find(1);
                $cc = [
                    'email' => $admin->email,
                ];

                $to = [
                    'email' => $user->email,
                ];
                Mail::to($to)
                    ->cc($cc)
                    ->queue(new ApplicationReport($user));
            }
        } else {

            $msg = "IPN was not verified \n";
            $msg .= "Verified=" . $verified . "\n";
            Log::info($msg);
        }
    }
}
