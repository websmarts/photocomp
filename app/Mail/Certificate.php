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

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;

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
            
            $data = $this->data;

            $this->pdf = PDF::loadView('admin.certificate', compact('data'));


            // Save pdf to storage
            // Storage::disk('public')->put('labels/labels_' . $user->id.'.pdf',$pdf->output());
            
             return $this->subject('Photo Competition Acceptance Certificate # ' . $data['id']++)
                    ->view('emails.acceptance_certificate')
                    ->attachData($this->pdf->output(), 'certificate.pdf',[ 'mime' => 'application/pdf']);
               
        }
        
        
       
    }
}
