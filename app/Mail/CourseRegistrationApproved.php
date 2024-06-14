<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CourseRegistrationApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $courseRegistration;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($courseRegistration)
    {
        $this->courseRegistration = $courseRegistration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Course Registration Approved')
                    ->view('emails.course_registration_approved');
    }
}
