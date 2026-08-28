<?php

namespace App\Mail;

use App\Models\CtnReservationMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FerryReservationReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly CtnReservationMessage $reservation) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New ferry reservation request #'.$this->reservation->id,
            replyTo: [$this->reservation->customer_email],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ferry-reservation-received',
        );
    }
}
