<?php

namespace App\Mail;

use App\Application;
use App\Photo;
use App\Section;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EntryReport extends Mailable
{
    use Queueable, SerializesModels;

    public $results;
    public $sections;
    public $photoCount;
    public $applicationCount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($results)
    {
        $this->results = $results;
        $this->sections = Section::with('category')->get();
        $this->photoCount = Photo::count();
        $this->applicationCount = Application::count();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Photo Competition Report')
            ->view('emails.entry_report');
    }
}
