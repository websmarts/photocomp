<?php

namespace App\Listeners;

use App\Events\UserHasRegistered;
use App\Mail\ConfirmEmail;
use Illuminate\Support\Facades\Mail;

class SendRegistrationEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserHasRegistered  $event
     * @return void
     */
    public function handle(UserHasRegistered $event)
    {
        $user = $event->user;
        Mail::to($user->email)->queue(new ConfirmEmail($user));
    }
}
