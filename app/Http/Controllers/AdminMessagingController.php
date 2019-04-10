<?php

namespace App\Http\Controllers;

use App\Application;
use App\Mail\EntryReport;
use App\Mail\SimpleMessage;
use App\Section;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class AdminMessagingController extends Controller
{
    public function index()
    {
        return view('admin.messaging_form');
    }

    public function messageAll(Request $request)
    {
        $email = $request->validate([
            'subject' => 'required|max:255',
            'content' => 'required',
        ]);

        if (starts_with(strtolower($email['subject']), 'test')) {
            $admin = User::find(1);
            $to = $admin->email;

            //return new SimpleMessage($email);

            Mail::to($to)->queue(new SimpleMessage($email));

            flash('A TEST messages has now been queued for sending to ' . $to);
            return redirect()->back();
        }

        $applicants = Application::whereNotNull('payment_method')->with('user')->get();

        //dd($applicants);

        $n = 0;
        foreach ($applicants as $applicant) {

            if (!$applicant->user->verified) {
                continue;
            }

            $to = $applicant->user->email;

            //return new SimpleMessage($email);

            Mail::to($to)->queue(new SimpleMessage($email));

            $n++;

        }
        flash('All (' . $n . ') messages have now been queued for sending out ');
        return redirect()->back();
    }

    public function messageResults(Request $request)
    {
        // dd($request);

        if (Input::hasFile('spreadsheet')) {

            $path = Input::file('spreadsheet')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();

            //dd($data);
            if (!empty($data) && $data->count()) {

                foreach ($data as $key => $value) {

                    $results[(int) $value->CompetitorNo][(int) $value->Section][(int) $value->EntryNo] = [
                        'competitorno' => (int) $value->CompetitorNo,
                        'salutation' => $value->Salutation,
                        'givennames' => $value->GivenNames,
                        'surname' => $value->Surname,
                        'email' => $value->Email,
                        'street1' => $value->Street1,
                        'street2' => $value->Street2,
                        'city' => $value->City,
                        'state' => $value->State,
                        'country' => $value->Country,
                        'postalcode' => $value->PostalCode,
                        'section' => (int) $value->Section,
                        'entryno' => (int) $value->EntryNo,
                        'title' => $value->Title,
                        'scorejudge1' => (int) $value->ScoreJudge1,
                        'scorejudge2' => (int) $value->ScoreJudge2,
                        'scorejudge3' => (int) $value->ScoreJudge3,
                        'scoretotal' => (int) $value->ScoreTotal,
                        'acceptance' => $value->Acceptance,
                        'specialaward' => $value->SpecialAward,
                        'specialawardname' => $value->SpecialAwardName,
                        'acceptancelevel' => (int) $value->AcceptanceLevel,
                    ];

                }

                 //dd(collect($results[1276]));

                // return new EntryReport(collect($results[1022]));

                $n = 0;
                foreach ($results as $competionNo => $sections) {
                    //return new EntryReport(collect($sections));
                    $sections = collect($sections);
                    //dd($sections);

                    // Skip if no email
                    if (!isset($sections->first()[1]['email'])) {
                        continue;
                    }

                    // skip if no entryno - bad export from David?
                    if (!isset($sections->first()[1]['entryno']) || $sections->first()[1]['entryno'] < 1) {
                        continue;
                    }

                    $to = $sections->first()[1]['email'];
                    //dd($sections);

                    // return new EntryReport($sections); // debug view - comment out for production
                    Mail::to($to)->queue(new EntryReport($sections));
                    
                    $n++;
                }

                return view('admin.messaging_queued', compact('n'));
            }

        }

        dd('all done');
    }
}
