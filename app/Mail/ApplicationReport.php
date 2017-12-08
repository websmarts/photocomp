<?php

namespace App\Mail;

use App\Category;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationReport extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $categories;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->categories = Category::with('sections')->get();

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirmation of Photo Competition Submission')->view('emails.application_report');
    }
}
