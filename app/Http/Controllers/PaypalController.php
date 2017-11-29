<?php

namespace App\Http\Controllers;

use Fahim\PaypalIPN\PaypalIPNListener;
use Illuminate\Support\Facades\Log;

class PaypalController extends Controller
{

    public function ipn()
    {
        $ipn = new PaypalIPNListener();
        $ipn->use_sandbox = true;

        $verified = $ipn->processIpn();

        $report = $ipn->getTextReport();

        Log::info("-----new payment-----");

        Log::info($report);

        if ($verified) {
            if ($_POST['address_status'] == 'confirmed') {
                // Check outh POST variable and insert your logic here
                Log::info("payment verified and inserted to db");
            }
        } else {
            Log::info("Some thing went wrong in the payment !");
        }
    }

}
