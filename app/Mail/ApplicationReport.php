<?php

namespace App\Mail;

use App\User;
use App\Category;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ApplicationReport extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $categories;
    public $pdf;
    public $printsCount;
    public $transactionId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->categories = Category::with('sections')->get();
        $this->printsCount = $this->user->prints->count();

        $this->transactionId = $user->application->txn_id;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        // Create labels pdf and attach IF the entry has any prints
        
        if($this->printsCount &&  $this->transactionId > ' ' ){
            
            $prints = $this->user->prints()
            ->orderBy('section_id','asc')
            ->orderBy('section_entry_number','asc')
            ->with('section')->get();
            
            $user = $this->user;
            $this->pdf = PDF::loadView('entries.labels', compact('user','prints'));


            // Save pdf to storage
            // Storage::disk('public')->put('labels/labels_' . $user->id.'.pdf',$pdf->output());
            
             return $this->subject('Confirmation of Photo Competition Submission')
                    ->view('emails.application_report')
                    ->attachData($this->pdf->output(), 'print_labels.pdf',[ 'mime' => 'application/pdf']);
               
        }
        
        // if no prints we dont attach pdf for labels
        return $this->subject('Confirmation of Photo Competition Submission')
                    ->view('emails.application_report');
       
    }
}
