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
            ->view('emails.confirm');
    }

    // Override the method in Mailable due to hicupp with PHP not liking
    /**
    $this->{$property}[] = [
    'name' => $recipient->name ?? null,
    'address' => $recipient->email,
    ];
     */

    /**
     * Set the recipients of the message.
     *
     * All recipients are stored internally as [['name' => ?, 'address' => ?]]
     *
     * @param  object|array|string  $address
     * @param  string|null  $name
     * @param  string  $property
     * @return $this
     */
    protected function setAddress($address, $name = null, $property = 'to')
    {
        foreach ($this->addressesToArray($address, $name) as $recipient) {
            $recipient = $this->normalizeRecipient($recipient);

            $tmp[] = [
                'name' => $recipient->name ?? null,
                'address' => $recipient->email,
            ];
            $this->{$property} = $tmp;
        }

        return $this;
    }
}
