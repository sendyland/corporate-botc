<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ParticipantRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;
    public $course;
    public $courseRegistration;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($participant, $course, $courseRegistration)
    {
        $this->participant = $participant;
        $this->course = $course;
        $this->courseRegistration = $courseRegistration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You have been registered for a course')
                    ->view('emails.participant_registered');
    }
}
