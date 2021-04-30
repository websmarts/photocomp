<?php

namespace App\Http\Controllers;

use App\User;
use App\Photo;
use App\Application;
use App\Mail\Certificate;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class AdminAcceptanceController extends Controller
{
    public function index()
    {
        //return view('admin.acceptances');

        $user = User::with(['photos.section', 'application'])->find(18); //->with('photos')->get();



        //dd($user);

        $pdf = PDF::loadView('admin.certificate', compact('user'));

        // Save pdf to storage
        // Storage::disk('public')->put('labels/labels_' . $user->id.'.pdf',$pdf->output());


        return $pdf->stream('certificate.pdf');
    }

    public function sendCertificates(Request $request)
    {
        // dd($request);

        if (Input::hasFile('spreadsheet')) {

            $path = Input::file('spreadsheet')->getRealPath();
            $data = Excel::load($path, function ($reader) {
            })->get();

            //dd($data);


            if (!empty($data) && $data->count()) {

                foreach ($data as $key => $value) {

                    $results[$value->email][] = [
                        'title' => $value->title,
                        'filepath' => $value->filepath,
                        'section' => $value->section_name,
                        'fullname' => $value->FullName,
                        'email' => $value->email,
                        'award' => $value->Award,

                    ];
                }

                // dd(collect($results));

                // return new EntryReport(collect($results[1022]));

                
                foreach ($results as $email => $certificates) {
                    $n = 0;
                    foreach ($certificates as $certificate) {
                        // Skip if no email
                        if (!isset($certificate['email'])) {
                            continue;
                        }


                        $to = $certificate['email'];

                        $certificate['id'] = $n;

                        //dd($certificate);

                        // Get the photo data
                        $certificate['photo'] = Photo::where('filepath','=',$certificate['filepath'])->get();
                        dd($certificate);
                        $div_x = $certificate['photo']->width / 600;
                        $div_y = $certificate['photo']->height / 300;
                        $div = 1;
                        if($div_x >= $div_y){
                            $div = $div_x;
                        } elseif ($div_y > $div_x) {
                            $div = $div_y;
                        }
                        $certificate['photo']->height = (int) $certificate['photo']->height / $div;
                        $certificate['photo']->width = (int) $certificate['photo']->width / $div;

                        dd($certificate);


                        // Next two lines used for debug to return cert view
                        $pdf = PDF::loadView('admin.certificate', compact('certificate'));
                        return $pdf->stream('certificate.pdf');

                        //Mail::to($to)->queue(new Certificate($certificate));

                        $n++;
                    }
                }
                dd('done');
                return view('admin.messaging_queued', compact('n'));
            }
        }

        dd('all done');
    }
}
