<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fullname;
    public $email;
    public $password;
    public $qr;

    /**
     * Create a new message instance.
     */
    public function __construct($fullname, $email, $password, $qr)
    {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->password = $password;
        $this->qr = $qr;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Welcome to E-Bisita')
                    ->view('emails.welcome');
    }
}
