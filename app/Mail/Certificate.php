<?php

namespace App\Mail;

use App\User;
use App\Category;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class Certificate extends Mailable
{
    use Queueable, SerializesModels;

    public $certificate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($certificate)
    {
        $this->certificate = $certificate;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        // Create certificate pdf and attach IF the entry is valid
        
        if(1 ){
            
            $certificate = $this->certificate;

            // if $certificate is an array then likely we have a number of
            // certificates to include in the pdf, not just one

            if(is_array($certificate) && count($certificate) > 0){
                
                $this->pdf = PDF::loadView('admin.certificates', ['certificates' => $certificate]);
                return $this->subject('Photo Competition Acceptance Certificates  ' )
                    ->view('emails.acceptance_certificate')
                    ->attachData($this->pdf->output(), 'certificates.pdf',[ 'mime' => 'application/pdf']);
            } else {
                $this->pdf = PDF::loadView('admin.certificate', compact('certificate'));
                return $this->subject('Photo Competition Acceptance Certificate # ' . $certificate['id']++)
                    ->view('emails.acceptance_certificate')
                    ->attachData($this->pdf->output(), 'certificate.pdf',[ 'mime' => 'application/pdf']);
            }



            // Save pdf to storage
            // Storage::disk('public')->put('labels/labels_' . $user->id.'.pdf',$pdf->output());
            
             
               
        }
        
        
       
    }
}
