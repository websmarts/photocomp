<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueueFailure extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Photocomp queue failure')
            ->view('emails.queue_failure');
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
