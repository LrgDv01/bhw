<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $bookingDetails;
    protected $qrCodePath;
    /**
     * Create a new message instance.
     */
    public function __construct($bookingDetails, $qrCodePath)
    {
        $this->bookingDetails = $bookingDetails;
        $this->qrCodePath = $qrCodePath;
    }
    public function build()
    {
        return $this->subject('New Booking Created')
                    ->view('emails.booking_notification')
                    ->with('bookingDetails', $this->bookingDetails)
                    ->attach($this->qrCodePath, [
                        'as' => 'booking_qr_code.png',
                        'mime' => 'image/png',
                    ]);;
    }
}
