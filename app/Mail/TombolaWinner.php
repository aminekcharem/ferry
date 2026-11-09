<?php

namespace App\Mail;

use App\Models\TombolaParticipation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TombolaWinner extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly TombolaParticipation $participation) {}

    public function envelope(): Envelope
    {
        $subject = match ($this->participation->locale) {
            'fr' => 'Vous avez gagné : réduction de ',
            'de' => 'Sie haben gewonnen: ',
            default => 'You won: discount of ',
        };

        return new Envelope(subject: $subject.$this->participation->result.' % — Yesmin Tours');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.tombola-winner');
    }
}
