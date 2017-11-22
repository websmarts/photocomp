<?php

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class AppMailer
{

    protected $mailer;

    protected $from;

    protected $fromName;

    protected $to;

    protected $view;

    protected $data = [];

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->from = env('MAIL_FROM_ADDRESS', 'admin@websmarts.com.au');
        $this->fromName = env('MAIL_FROM_NAME', 'Administrator');
    }

    public function deliver()
    {
        $this->mailer->send($this->view, $this->data, function ($message) {
            $message->from($this->from, $this->fromName)
                ->to($this->to)->subject('Confirm your email address');
        });
    }

    public function sendEmailConfirmationTo(User $user)
    {
        $this->to = $user->email;
        $this->view = 'emails.confirm';
        $this->data = compact('user');

        $this->deliver();
    }
}
