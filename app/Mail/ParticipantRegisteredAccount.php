<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParticipantRegisteredAccount extends Mailable
{
    use Queueable, SerializesModels;

    public $employed;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employed, $password)
    {
        $this->employed = $employed;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have been registered to the learning website')
                    ->view('emails.participant_registered_account');
    }
}
