<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    // public $from;

    // public $fromName;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->from = env('MAIL_FROM_ADDRESS', 'admin@websmarts.com.au');
        // $this->fromName = env('MAIL_FROM_NAME', 'Administrator');
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Confirm your email address')
            ->from('admin@websmarts.com.au')
            ->view('emails.confirm');
    }
}
