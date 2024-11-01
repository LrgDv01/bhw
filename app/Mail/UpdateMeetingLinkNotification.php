<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdateMeetingLinkNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $bookingDetails;
    
    public function __construct($bookingDetails)
    {
        $this->bookingDetails = $bookingDetails;
    }
    public function build()
    {
        return $this->subject('Updated Meeting Link')
                    ->view('emails.update_meeting_link');
    }
}
